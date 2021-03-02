<?php

namespace App\Http\Controllers\Account;

use App\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Helpers\JsonHelper;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Mail\RefundRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderMarkedAsDelivered;
use App\Repositories\Account\OrderRepository;
use App\Notifications\ClientOrderMarkedAsDelivered;

class OrderController extends \App\Http\Controllers\Controller
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }



    public function index(Request $request)
    {
        $all_orders = Auth::user()->orders()->with('items')->latest();

        $orders = [];
        $order_items = [];

        $searchFilter = $request->get('search', null);
        $startFilter =  $request->get('start') ? Carbon::parse($request->get('start'))->startOfDay()->format('Y/m/d') : null;
        $endFilter = $request->get('end') ? Carbon::parse($request->get('end'))->endOfDay()->format('Y/m/d') : null;
        if ($startFilter) {
            $all_orders->whereDate('created_at', '>=', $startFilter);
        }
        if ($endFilter) {
            $all_orders->whereDate('created_at', '<=', $endFilter);
        }

        if (request('filter') == 'order_items') {
            $order_items = OrderItem::with(['product_variant.product.store', 'product_variant.product.category'])->whereIn('order_id', $all_orders->pluck('id'))->latest();

            if ($searchFilter) {
                // dd($orders->first()->user);
                $order_items = $order_items->where('id', 'LIKE', '%' . $searchFilter . '%')
                    ->orWhereHas('product_variant.product', function ($p) use ($searchFilter) {
                        $p->where('name', 'LIKE', '%' . $searchFilter . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchFilter . '%');
                    });
            }

            $order_items = $order_items->paginate(8);
        } else {
            $orders = $all_orders;

            if ($searchFilter) {
                $orders = $orders->where(function ($query) use ($searchFilter) {
                    $query->where('id', 'LIKE', '%' . $searchFilter . '%')
                        ->orWhereHas('items.product_variant.product', function ($p) use ($searchFilter) {
                            $p->where('name', 'LIKE', '%' . $searchFilter . '%')
                                ->orWhere('description', 'LIKE', '%' . $searchFilter . '%');
                        })->orWhereHas('shipping_address', function ($a) use ($searchFilter) {
                            $a->where('given_name', 'LIKE', '%' . $searchFilter . '%')
                                ->orWhere('family_name', 'LIKE', '%' . $searchFilter . '%');
                        });
                });
                // dd($orders->get()->toArray());
            }

            $orders = $orders->paginate(8);
        }



        return view('account.orders.index', compact('orders', 'order_items', 'searchFilter', 'startFilter', 'endFilter'));
    }



    public function refund($id)
    {
        $order = Order::with(['user', 'items.product_variant.product.store'])->find($id);
        // dd($order->toArray());

        if (empty($order)) {
            alert()->error('Pedido no encontrado');

            return redirect(route('account.orders.index'));
        }

        if (!$order->canAskRefund()) {
            alert()->error('El pedido no califica para devolución, contáctanos para obtener más información');

            return redirect(route('account.orders.index'));
        }
        $input = request()->all();

        $admins = User::whereIs('super-user')->get();

        foreach ($admins as $key => $admin) {
            Mail::to($admin)->cc(setting('admin_email', 'info@armariomovil.com'))->send(new RefundRequested($order, $admin, $input));
        }

        $order->status_id = OrderStatus::whereSlug('refund')->first()->id;
        $order->save();

        alert()->success('Tu solicitud de devolución se envió exitosamente');
        return redirect(url('account/orders'));
    }


    public function addBill($id, Request $request)
    {
        $input = $request->all();
        $order = Order::find($id);

        if (!isset($input['bill_file'])) {
            alert()->error('Ha ocurrido un error al cargar tu factura', 'Recuerda que aceptamos formatos de factura en PDF, JPG y PNG');

            return redirect(route('account.orders.index'));
        }
        $mainImage = JsonHelper::jsonOrEmpty($input['bill_file']);

        $order->saveBillDocument($mainImage['path'], $input['store_id'] ?? null);

        alert()->success('Tu factura se ha cargado correctamente');

        return back();
    }


    public function status($id)
    {
        $order = Order::with(['user', 'items.product_variant.product.store'])->find($id);
        $status = OrderStatus::whereSlug(request('status_slug'))->first();

        if (!$status) {
            alert()->error('Error al cargar pedido');

            return redirect(route('account.orders.index'));
        }

        if (!$order) {
            alert()->error('Pedido no encontrado');

            return redirect(route('account.orders.index'));
        }


        if ($status->slug != 'completed') {
            alert()->error('Pedido no se puede marcar como entregado');

            return redirect(route('account.orders.index'));
        }

        $products = $order->items->map(function ($item) {
            return $item->product_variant->product;
        })->unique();
        foreach ($products as $key => $product) {
            // Notify to Store Owner *per product*
            $product->store->user->notify(new OrderMarkedAsDelivered($product, auth()->user()));
        }

        foreach ($order->items as $key => $item) {
            $item->status = 'Entregado';
            $item->save();
        }

        // Notify User Client
        auth()->user()->notify(new ClientOrderMarkedAsDelivered($order));

        $order->status_id = $status->id;
        $order->save();

        alert()->success('Has marcado tu pedido como entregado');
        return redirect(url('account/orders'));
    }



}
