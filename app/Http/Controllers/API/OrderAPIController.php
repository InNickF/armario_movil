<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Order;
use App\Models\CartModel;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OrderRepository;
use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Models\ProductVariant;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends \App\Http\Controllers\Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return Response
     */
    // public function index(Request $request)
    // {
    //     $orders = QueryBuilder::for(Address::class)
    //             // ->allowedIncludes('categories', 'store', 'questions')
    //             // ->allowedFilters('is_paying', 'is_collecting', 'is_primary', 'is_shipping', 'is_billing')
    //             // ->defaultSort('created_at')
    //             // ->allowedSorts('name', 'created_at')
    //             // ->allowedAppends('final_price')
    //             // ->where('is_active', true)
    //             ->where('user_id', Auth::user()->id)
    //             // ->take(8)
    //             ->get();

    //     return $orders;
    // }

    /**
     * Store a newly created Order in storage.
     * POST /orders
     *
     * @param CreateOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderAPIRequest $request)
    {
        \Cart::session(CartModel::getUserIdentifier());

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $input['status_id'] = OrderStatus::whereSlug('pending')->first()->id;

        $orderData = $input;

        // Get shipping Cart Conditions
        $local_condition = \Cart::getCondition('Envío local');
        $national_condition = \Cart::getCondition('Envío nacional'); // This goes for both National and Galapagos
        $galapagos_condition = \Cart::getCondition('Envío Galápagos'); // This goes for both galapagos and Galapagos

        if ($national_condition) {
            $conditionCalculatedValue = $national_condition->getValue(); // Just get value because is never percentage
            $orderData['national_shipping_price'] = $conditionCalculatedValue;
            $orderData['local_shipping_price'] = 0;
        } else if ($galapagos_condition) {
            // * Galapagos goes as National
            $conditionCalculatedValue = $galapagos_condition->getValue(); // Just get value because is never percentage
            $orderData['national_shipping_price'] = $conditionCalculatedValue;
            $orderData['local_shipping_price'] = 0;
        } else if ($local_condition) {
            $conditionCalculatedValue = $local_condition->getValue(); // Just get value because is never percentage
            $orderData['local_shipping_price'] = $conditionCalculatedValue;
            $orderData['national_shipping_price'] = 0;
        } else {
            $orderData['local_shipping_price'] = 0.00;
            $orderData['national_shipping_price'] = 0.00;
        }




        $total_shipping = $orderData['local_shipping_price'] + $orderData['national_shipping_price']; // This is already included in total_price as Cart Conditions
        $orderData['total_shipping_price'] = $total_shipping;

        // Get taxes and shipping subtotals
        $orderData['total_price'] = (float) \Cart::getTotal(false);
        $orderData['vat_price'] = $orderData['total_price'] - ($orderData['total_price'] / 1.12); // VAT with shipping
        $orderData['subtotal'] = (float) (\Cart::getSubTotal(false) - $orderData['vat_price']);

        $orderData['conditions'] = \Cart::getConditions(); // Save conditions in DDBB just in case


        /**
         * CHECK & UPDATE COUPON
         */
        $coupon_condition = \Cart::getConditionsByType('coupon')->first(); // This goes for both National and Galapagos
        if ($coupon_condition) {

            $conditionCalculatedValue = $coupon_condition->getCalculatedValue(\Cart::getSubTotal(false));
            $orderData['coupon_discount'] = $conditionCalculatedValue;

            $coupon = $coupon_condition->getAttributes()['coupon'];
            $orderData['coupon_id'] = $coupon->id;

            $coupon->uses_count++;
            $coupon->save();
        } else {
            $orderData['coupon_discount'] = 0.00;
        }


        $order = $this->orderRepository->create($orderData);
        \Log::info('Pedido creado');
        \Log::info($order->toArray());

        // Transform cart content into new OrderItems
        foreach (\Cart::getContent() as $key => &$orderItem) {
            $productVariant = ProductVariant::find($orderItem['id']);

            // $config = ['format_numbers' => true, 'decimals' => 2, 'dec_point' => '.', 'thousands_sep' => ','];
            $unit_price_subtotal = (float) $orderItem->price; // Subtotal has VAT included
            $unit_price_final = (float) $orderItem->getPriceWithConditions(); // Final adds coupons and shipment, VAT is included in original value ($orderItem->price)
            $sum_price_subtotal = (float) $orderItem->getPriceSum();
            $sum_price_final =  (float) $orderItem->getPriceSumWithConditions();

            // Check if coupon applies to this product
            $coupon_id = null;
            $coupon_discount = 0;
            if ($order->coupon && $productVariant->product->validateCoupon($order->coupon)) {
                $coupon_id = $order->coupon ? $order->coupon_id : null;
                $coupon_discount = $order->coupon->getCalculatedDiscountValue($sum_price_subtotal);
            }

            // ! Calculate commission dividing by 1.$commission_percentage same as VAT
            $subtotal_without_vat = $sum_price_final / 1.12;
            // Get VAT subtotal
            $vat_price = $sum_price_final - $subtotal_without_vat;

            // Calculate earning & commission
            $commission_percentage = $productVariant->product->store->user->plan->features->firstWhere('name', 'commission_percentage')->value;
            $divisor = 1 + ($commission_percentage / 100);
            $earning = $subtotal_without_vat / $divisor;

            $commission_price = $subtotal_without_vat - $earning;


            $newOrderItem = [
                'product_variant_id' => $orderItem['id'],
                'order_id' => $order->id,
                'quantity' => $orderItem->quantity,
                'unit_price_subtotal' => round($unit_price_subtotal, 2),
                'unit_price_final' => round($unit_price_final, 2),
                'sum_price_subtotal' => round($sum_price_subtotal, 2),
                'sum_price_final' => round($sum_price_final, 2),
                'coupon_id' => $coupon_id,
                'coupon_discount' => round($coupon_discount, 2),
                'vat_price' => round($vat_price, 2),
                'commission_percentage' => $commission_percentage,
                'commission_price' => round($commission_price, 2),
                'earning' => round($earning, 2),
                'conditions' => $orderItem->getConditions(), // Item specific conditions only, NO shipping or coupon here
                'shipping_provider' => $orderItem['attributes']['shipping_provider']
            ];
            OrderItem::create($newOrderItem);
        }
        // return $this->sendError($order);

        \Cart::clear();
        \Cart::clearCartConditions();

        return $order;
    }

    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Pedido no encontrado');
        }
        if ($order->user_id != auth('api')->user()->id) {
            return $this->sendError('No puedes ver pedidos de otro usuario');
        }

        return $this->sendResponse($order->toArray(), 'Pedido obtenido');
    }




    public function pay($id)
    {
        // payment is Paymentez response object
        if (!request()->has('orderUuid') || !request()->has('payment')) {
            return $this->sendError('Datos no válidos');
        }

        $order = Order::where('id', $id)->where('uuid', request('orderUuid'))->first();

        if (!$order) {
            return $this->sendError('No se ha encontrado el pedido');
        }

        if ($order->user_id != Auth::user()->id) {
            return $this->sendError('Permiso denegado');
        }

        if (!$order->productsHaveStock()) {
            return $this->sendError('No se puede realizar el pago, uno o varios productos de este pedido ya no se encuentran en stock');
        }

        if (!$order->canOrderProducts()) {
            return $this->sendError('No se puede realizar el pago, los productos del pedido no cuentan con la cantidad requerida en stock');
        }

        // Only pay if status is NEW or PENDING
        if ($order->status->slug == 'new' || $order->status->slug == 'pending') {

            // Generate transaction, decrease stock, send notifications and change status
            try {
                $order->onPaid(request('payment'));
                \Log::info('OrderAPIController after onPaid order updated ' . $id);
                \Log::info($order);
            } catch (\Throwable $th) {
                return $this->sendError($th->getMessage());
                \Log::error($th);
            }

            return $this->sendResponse(['success' => true], 'Se ha procesado tu pedido exitosamente');
        } else {
            return $this->sendResponse(['success' => true], 'Ya se ha realizado el pago de este pedido');
        }
    }





    // public function shipping($addressId)
    // {
    //     $address = Address::find($addressId);

    //     if (empty($address)) {
    //         return $this->sendError('Address no encontrad@');
    //     }

    //     \Cart::session(CartModel::getUserIdentifier());




    //     return $this->sendResponse($order->toArray(), 'Order retrieved successfully');
    // }

}
