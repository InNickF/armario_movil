<?php

namespace App\Http\Controllers\API;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ProductAddedToCart;
use App\Http\Controllers\AppBaseController;
use App\Notifications\ProductRemovedFromCart;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */

class CartAPIController extends \App\Http\Controllers\Controller
{
    public function store(Request $request)
    {
        $input = $request->validate([
            'product_id' => 'required|integer|min:1', // real product id
            'variant_id' => 'required|integer|min:1',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);

        $productId = $input['product_id'];
        $product = Product::find($productId);

        $variantId = $input['variant_id'];
        $productVariant = ProductVariant::with('product')->find($variantId);

        if (!$product) {
            return $this->sendError('Producto no encontrado');
        }

        if (!$productVariant) {
            return $this->sendError('No se ha seleccionado la variante de color');
        }

        $productWithVariantData = [
            'image' => $product->getColorVariantImage($productVariant->color),
            'quantity' => $productVariant->quantity, // STOCK
            'variant' => $productVariant,
            'store_id' => $productVariant->product->store->id
        ];

        $existingInCart = \Cart::getContent()->firstWhere('id', $productVariant->id);

        if ($existingInCart) {
            $sum = $existingInCart['quantity'] + $input['quantity'];

            if ($sum > $productVariant->quantity) {
                // If sum of existing + newlyi added is more than stock, default to what is left to complete stock
                $input['quantity'] = $productVariant->quantity - $existingInCart['quantity'];
            }

            if ($input['quantity'] <= 0) {
                return $this->sendError('Ya has agregado el máximo de stock del producto a tu carrito');
            }
        } else {
            // If not existing, compare from original stock
            if ($input['quantity'] > $productVariant->quantity) {
                return $this->sendError('La cantidad excede el stock del producto');
            }
        }

        $cartProduct = array(
            'id' => $productVariant->id,
            'name' => $product->name,
            'price' => $product->final_price,
            'quantity' => $input['quantity'],
            'attributes' => $productWithVariantData
        );
        \Log::info('Product added to cart');
        // \Log::info($cartProduct);

        \Cart::add($cartProduct);

        // CartModel::updateShippingCosts();

        // Notify to Product Owner
        $product->store->user->notify(new ProductAddedToCart($product, auth('api')->user()));

        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Product added to cart');
    }

    public function show()
    {
        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);
        // CartModel::applyBaseConditions();
        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Cart retrieved');
    }


    public function update(Request $request)
    {
        $input = $request->validate([
            'variant_id' => 'required|integer|min:1',
            'quantity' => 'required|integer',
        ]);

        // Log::info($input);

        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);

        $variantId = $input['variant_id'];
        $productVariant = ProductVariant::find($variantId);
        if (!$productVariant) {
            return $this->sendError('No se ha seleccionado la variante de color');
        }


        $product = $productVariant->product;
        if (!$product) {
            return $this->sendError('Producto no encontrado');
        }


        if ($input['quantity'] > $productVariant->quantity) {
            return $this->sendError('La cantidad excede el stock del producto');
        }

        $cartProduct = array(
            'id' => $productVariant->id,
            // 'name' => $product->name,
            // 'price' => $product->final_price,
            'quantity' => array(
                'relative' => false,
                'value' => $input['quantity']
            ),
            // 'attributes' => $productWithVariantData
        );

        if ($input['quantity'] == 0) {
            \Cart::remove($productVariant->id);
            // Notify to Product Owner only if is remove
            $product->store->user->notify(new ProductRemovedFromCart($product, auth('api')->user()));
        } else {
            \Cart::update($productVariant->id, $cartProduct);
        }

        // Log::info('finished updating product in cart');

        if (\Cart::getTotalQuantity() <= 0) {
            \Cart::clear();
            \Cart::clearCartConditions();
        } else {
            CartModel::updateShippingCosts();
        }


        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Product updated in cart');
    }

    public function removeProduct()
    {
        $variantId = request('product_id');
        $productVariant = ProductVariant::find($variantId);
        if (!$productVariant) {
            return $this->sendError('No se ha seleccionado la variante de color');
        }

        $product = $productVariant->product;
        if (!$product) {
            return $this->sendError('Producto no encontrado');
        }


        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);

        \Cart::remove(request('product_id'));

        if (\Cart::getTotalQuantity() <= 0) {
            \Cart::clear();
            \Cart::clearCartConditions();
            // return $this->sendResponse([], 'Cart is empty');
        } else {
            CartModel::updateShippingCosts();
        }

        // Notify to Product Owner
        $product->store->user->notify(new ProductRemovedFromCart($product, auth('api')->user()));

        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Product removed from cart');
    }


    public function calculateShipping(Request $request)
    {
        \Log::info('calculateShipping...');

        if (!$request->has('address_id')) {
            $this->sendError('No se ha encontrado el parámetro address_id');
        }
        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);

        CartModel::updateShippingCosts($request->get('address_id'));

        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Address updated in cart');
    }



    public function coupon(Request $request)
    {
        $attributes = $request->validate([
            'code' => 'required|min:1',
        ]);


        $coupon = Coupon::whereCode($attributes['code'])->first();

        if (!$coupon) {
            return $this->sendError('El cupón ingresado no existe');
        }

        if (!$coupon->isValid('products')) {
            return $this->sendError('El cupón ingresado no es válido');
        }

        $userId = CartModel::getUserIdentifier();
        \Cart::session($userId);

        // This is the where condition is calculated and applied
        $applied = CartModel::applyCouponAsCondition($coupon);

        \Log::info($applied);

        if (!$applied) {
            return $this->sendError('El cupón ingresado no se pudo aplicar');
        }

        return $this->sendResponse(CartModel::getCartAttributes($userId), 'Coupon applied to cart');
    }
}
