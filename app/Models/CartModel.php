<?php

namespace App\Models;

use App\Models\Coupon;
use App\Models\Address;
use App\Models\UserStore;
use Illuminate\Support\Str;
use App\Services\GlovoService;
use Illuminate\Support\Facades\DB;
use Darryldecode\Cart\CartCondition;
use Darryldecode\Cart\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table = 'cart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'cart_data',
    ];

    public function setCartDataAttribute($value)
    {
        $this->attributes['cart_data'] = serialize($value);
    }

    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }


    public static function getCartAttributes($userId)
    {
        $subTotal = \Cart::getSubTotal(false);
        $products = \Cart::getContent()->sort();
        $config = ['format_numbers' => true, 'decimals' => 2, 'dec_point' => '.', 'thousands_sep' => ','];

        // If a coupon exists as condition, recalculate in every request in case item quantity changed
        $couponCondition = \Cart::getConditionsByType('coupon')->first();
        $couponDiscount = 0;
        if ($couponCondition) {
            $couponId = $couponCondition->getAttributes()['coupon']['id'];
            $coupon = Coupon::find($couponId);
            CartModel::applyCouponAsCondition($coupon);
            $couponDiscount = $couponCondition->getCalculatedValue($subTotal);
        }

        $cartConditions = \Cart::getConditions();
        $conditionsWithAttributes = [];
        foreach ($cartConditions as $condition) {
            $conditionsWithAttributes[] = [
                'target' =>  $condition->getTarget(),
                'name' =>  $condition->getName(),
                'type' =>  $condition->getType(),
                'value' =>  $condition->getValue(),
                'order' =>  $condition->getOrder(),
                'attributes' =>  $condition->getAttributes(),
                'calculated_value' => Helpers::formatValue($condition->getCalculatedValue($subTotal), true, $config)
            ];
        }

        $itemsCondition = null;
        $sum_items_discount = 0;
        foreach ($products as &$item) {
            $item['price'] = Helpers::formatValue($item->price, true, $config);
            $item['price_with_conditions'] = Helpers::formatValue($item->getPriceWithConditions(), true, $config);
            $item['price_sum'] = $item->getPriceSum();
            $item['price_sum_with_conditions'] = $item->getPriceSumWithConditions();
            $item['attributes'] = $item->attributes;
            // $item['conditions'] = $item->conditions;

            // * In case per item conditions applied, this adds as a global condition to the cart
            // foreach ($item->conditions as $condition) {
            //     // Add per item conditions too, but dont repeat, sum discounts as one
            //     $sum_items_discount += $condition->getCalculatedValue($subTotal) * $item->quantity;
            //     $itemsCondition = [
            //         'type' =>  $condition->getType(),
            //         'name' =>  $condition->getName(),
            //         'value' =>  $condition->getValue(),
            //         'order' =>  $condition->getOrder(),
            //         'attributes' =>  $condition->getAttributes(),
            //         'calculated_value' => Helpers::formatValue($sum_items_discount, true, $config)
            //     ];
            // }
        }

        // Add items unified condition as cart condition
        // if($itemsCondition) {
        //     $conditionsWithAttributes[] = $itemsCondition;
        // }


        return [
            'subtotal' =>  Helpers::formatValue($subTotal + $sum_items_discount, true, $config), // Subtotal manually calculated to get item prices without conditions
            'total' => \Cart::getTotal(true),
            'empty' =>  \Cart::isEmpty(),
            'count' =>  \Cart::getTotalQuantity(),
            'products' =>  $products,
            'conditions' => $conditionsWithAttributes,
            'userId' => $userId
        ];
    }

    // public static function applyBaseConditions()
    // {
    // add single condition on a cart bases
    // $condition = new CartCondition(array(
    //     'name' => 'IVA ' . config('armario.taxes.iva') . '%',
    //     'type' => 'tax',
    //     'target' => 'total',
    //     'value' => config('armario.taxes.iva') . '%',
    //     'order' => 1,
    //     'attributes' => array( // attributes field is optional
    //         'description' => 'Impuesto al valor agregado',
    //         'more_data' => 'more data here'
    //     )
    // ));

    // \Cart::condition($condition); // for a speicifc user's cart

    // CartModel::updateShippingCosts();
    // }





    public static function updateShippingCosts($addressId = null)
    {
        \Log::info('updateShippingCosts...');
        $costs = [];
        $items = \Cart::getContent();

        // // $storesIds = [];
        if (!auth('api')->check()) {
            return;
        }

        $localItems = 0;
        $nationalItems = 0;
        $galapagosItems = 0;

        // If address in params means a new address submitted via calculateShipping method
        if (!$addressId) {
            // If no address in params search addressId in any of the existing shipping conditions
            $local_shipping = \Cart::getConditionsByType('local_shipping')->first();
            $national_shipping = \Cart::getConditionsByType('national_shipping')->first();
            $galapagos_shipping = \Cart::getConditionsByType('galapagos_shipping')->first();

            if ($galapagos_shipping) {
                $addressId = $galapagos_shipping->getAttributes()['address_id'];
            }
            if ($local_shipping) {
                $addressId = $local_shipping->getAttributes()['address_id'];
            }
            if ($national_shipping) {
                $addressId = $national_shipping->getAttributes()['address_id'];
            }
        }

        if (!$addressId) {
            return;
        }

        $address = Address::find($addressId);

        foreach ($items as &$item) {
            $store = UserStore::find($item['attributes']['store_id']);

            if (!$store) {
                return;
            }

            // address in GALAPAGOS case first because no need to estimate Glovo
            if (upper_case($address->state) == 'GALAPAGOS' || upper_case($store->address->state) == 'GALAPAGOS') {
                $galapagosItems++;
                $item['attributes']['shipping_provider'] = 'Urbano';

                \Cart::update($item->id, [
                  'attributes' => $item['attributes']
                ]);
            } else {
                // If is GLOVO, compare with client address too, if both points out of coverage turn to national
                $glovo = new GlovoService();
                // ! This validates as true some areas outside Quito
                $isInWorkingArea = $glovo->isInWorkingArea(
                    $store->address->latitude,
                    $store->address->longitude,
                    $address->latitude,
                    $address->longitude
                );
                // If is in Glovo coverage area mark as local
                if ($isInWorkingArea) {
                    $localItems++;
                    $item['attributes']['shipping_provider'] = 'Glovo';

                    \Cart::update($item->id, [
                      'attributes' => $item['attributes']
                    ]);
                } else {
                    // If is not in Glovo coverage area mark as national
                    $nationalItems++;
                    $item['attributes']['shipping_provider'] = 'Urbano';

                    \Cart::update($item->id, [
                      'attributes' => $item['attributes']
                    ]);
                }
            }
        }

        if ($localItems > 0) {
            $base = setting('local_shipping_base_price', 3.50);
            $extra = 0;

            // Add one extra per every item even from other destinations
            if ($items->count() > 1) {
                $extra = ($items->count() - 1) * setting('local_shipping_price_per_extra_product', 0.875);
            }
            $costs['local'] = [
              'name' => 'Envío local',
              'description' => '(Hasta 3 horas)',
              'value' => $base + $extra,
              'address_id' => $addressId
          ];
        }

        if ($nationalItems > 0) {
            $base = setting('national_shipping_base_price', 6);
            $extra = 0;
            // Add one extra per every item even from other destinations
            if ($items->count() > 1) {
                $extra = ($items->count() - 1) * setting('national_shipping_price_per_extra_product', 3);
            }
            $costs['national'] = [
              'name' => 'Envío nacional',
              'description' => '(De 1 a 3 días)',
              'value' => $base + $extra,
              'address_id' => $addressId
          ];
        }


        if ($galapagosItems > 0) {
            $base = setting('galapagos_shipping_base_price', 13);
            $extra = 0;
            // Add one extra per every item even from other destinations
            if ($items->count() > 1) {
                $extra = ($items->count() - 1) * setting('galapagos_shipping_price_per_extra_product', 13);
            }
            $costs['galapagos'] = [
              'name' => 'Envío Galápagos',
              'description' => '(Hasta 8 días)',
              'value' => $base + $extra,
              'address_id' => $addressId
          ];
        }

        \Log::info('Shipping costs calculated');
        \Log::info($costs);

        CartModel::updateShippingCondition($costs);
    }




    public static function updateShippingCondition($data)
    {
        \Log::info('updateShippingCondition...');
        \Log::info($data);
        \Cart::removeConditionsByType('local_shipping');
        \Cart::removeConditionsByType('national_shipping');
        \Cart::removeConditionsByType('galapagos_shipping');
        if (!isset($data['local']) && !isset($data['national']) && !isset($data['galapagos'])) {
            return;
        }

        // JUST ONE SHIPPING COST
        if (isset($data['galapagos'])) {
            $galapagos = new CartCondition(array(
                'name' => $data['galapagos']['name'],
                'type' => 'galapagos_shipping',
                'target' => 'total',
                'value' => $data['galapagos']['value'],
                'order' => 2,
                'attributes' => [
                    'description' => $data['galapagos']['description'],
                    'address_id' => $data['galapagos']['address_id']
                ]
            ));
            \Cart::condition($galapagos);
        } elseif (isset($data['national'])) {
            $national = new CartCondition(array(
                'name' => $data['national']['name'],
                'type' => 'national_shipping',
                'target' => 'total',
                'value' => $data['national']['value'],
                'order' => 2,
                'attributes' => [
                    'description' => $data['national']['description'],
                    'address_id' => $data['national']['address_id']
                ]
            ));
            \Cart::condition($national);
        } elseif (isset($data['local'])) {
            $local = new CartCondition(array(
                'name' => $data['local']['name'],
                'type' => 'local_shipping',
                'target' => 'total',
                'value' => $data['local']['value'],
                'order' => 2,
                'attributes' => [
                    'description' => $data['local']['description'],
                    'address_id' => $data['local']['address_id']
                ]
            ));
            \Cart::condition($local);
        }
    }


    public static function getCouponDiscountFormatted(Coupon $coupon)
    {
        switch ($coupon->type) {
            case 'money':
                return '-' . $coupon->discount;
                break;

            case 'percentage':
                return '-' . $coupon->discount . '%';
                break;

            default:
                return $coupon->discount;
                break;
        }
    }


    public static function getUserIdentifier()
    {
        if (auth('api')->check()) {
            $userId = auth('api')->user()->id;
        } else {
            if (request()->userId) {
                $userId = request()->userId;
            } else {
                $userId = Str::uuid();
            }
        }
        return $userId;
    }

    public static function transferCart($from, $to)
    {
        //Clear previous user cart row
        // update ID
        $sessionItemsId = $from . '_cart_items';
        $userItemsId = $to . '_cart_items';

        // Log::info('Transfering cart from ' . $from . ' to ' . $to);

        $existingUserCarts = DB::table('cart')
            ->where('id', $userItemsId);
        // Log::info($existingUserCarts->get());
        if ($existingUserCarts) {
            $existingUserCarts->delete();
        }

        $sessionCart = DB::table('cart')
            ->where('id', $sessionItemsId);

        // Log::info($sessionCart->get());
        $sessionCart->update(['id' => $userItemsId]);
        // Log::info($sessionCart->get());

        $sessionConditionsId = $from . '_cart_conditions';
        $userConditionsId = $to . '_cart_conditions';


        $existingUserConditions = DB::table('cart')
            ->where('id', $userConditionsId);
        // Log::info($existingUserConditions->get());
        if ($existingUserConditions) {
            $existingUserConditions->delete();
        }

        $sessionConditions = DB::table('cart')
            ->where('id', $sessionConditionsId);

        // Log::info($sessionConditions->get());
        $sessionConditions->update(['id' => $userConditionsId]);
        // Log::info($sessionConditions->get());
    }




    // public static function getIdFromCartComposedKey($key)
    // {
    //     $parts = explode("_", $key);
    //     if (empty($parts)) {
    //         return null;
    //     }

    //     return $parts[0];
    // }

    // public static function makeProductWithColorKey($data)
    // {
    //     $id = CartModel::getIdFromCartComposedKey($data['product_id']);
    //     return $id . '_' . $data['color'];
    // }

    public static function applyCouponAsCondition(Coupon $coupon)
    {
        /**
         * Remove other coupons
         */
        \Cart::removeConditionsByType('coupon');

        // * This was removing per item conditions, not used anymore
        // foreach (\Cart::getContent() as $orderItem) {
        //     \Cart::clearItemConditions($orderItem['id']);
        // }

        // $discount = CartModel::getCouponDiscountFormatted($coupon);

        // If coupon has no specific filters, apply to cart
        $discountTotal = $coupon->getCalculatedDiscountValue(\Cart::getSubTotal(false));
        if (!$coupon->hasFilters()) {
            $couponCondition = new CartCondition(array(
                'name' => $coupon->code . ': ' . $coupon->name,
                'type' => 'coupon',
                'target' => 'total',
                'value' =>  '-' . $discountTotal,
                'attributes' => array( // attributes field is optional
                    'coupon' => $coupon,
                    'description' => $coupon->description,
                )
            ));

            \Cart::condition($couponCondition);

            return true;
        } else {
            // If has to be filtered
            // $productsMatchingCoupon = [];
            $discountSum = 0;
            foreach (\Cart::getContent() as $cartItem) {
                $productVariant = ProductVariant::find($cartItem['id']);
                if ($productVariant->product->validateCoupon($coupon)) { // Apply only if is valid to this product4
                    // $productsMatchingCoupon[] = [
                    //     'item_id' => $cartItem['id'],
                    //     'calculated_discount' => $coupon->getCalculatedDiscountValue($cartItem['price_sum'])
                    // ];
                    $discountSum += ($coupon->getCalculatedDiscountValue($cartItem->getPriceSum())); // Sum calculated discount for every cart item
                }
            }

            if ($discountSum <= 0) {
                return false;
            }

            // foreach ($productsMatchingCoupon as $orderItemId) {
            // $itemCondition = new CartCondition(array(
            //     'name' => $coupon->code . ': ' . $coupon->name,
            //     'type' => 'coupon',
            //     'value' => $discount,
            //     'attributes' => array( // attributes field is optional
            //         'coupon' => $coupon,
            //         'description' => $coupon->description,
            //     )
            // ));

            // \Cart::addItemCondition($orderItemId, $itemCondition);
            // }

            $couponCondition = new CartCondition(array(
                'name' => $coupon->code . ': ' . $coupon->name,
                'type' => 'coupon',
                'target' => 'total',
                'value' =>  '-' . $discountSum, // apply a fixed value if its per item based conditions, if percentage will override and apply to all
                'attributes' => array( // attributes field is optional
                    'coupon' => $coupon,
                    'description' => $coupon->description,
                )
            ));

            \Cart::condition($couponCondition);

            return true;
        }
    }
}
