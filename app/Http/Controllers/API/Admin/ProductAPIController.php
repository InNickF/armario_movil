<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Product;
use App\Notifications\ProductFromFollowerStoreCreated;

/**
 * Class ProductController.
 */
class ProductAPIController extends \App\Http\Controllers\Controller
{
    public function changePlan($id)
    {
        $input = request()->all();
        $product = Product::find($id);
        $plan = app('rinvex.subscriptions.plan')->find($input['planId']);

        if (empty($plan)) {
            return $this->sendError('Plan no encontrado');
        }

        if (empty($product)) {
            return $this->sendError('Producto no encontrado');
        }

        if ($product->getSubscription()) {
            $product->getSubscription()->changePlan($plan);
        }

        return $this->sendResponse($plan->toArray(), 'Product plan changed successfully');
    }

    public function toggleActive($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            return $this->sendError('Producto no encontrado');
        }

        $comment = request('comment');

        $product->is_active = !$product->is_active;
        $product->admin_comment = $comment;
        $product->save();

        if ($product->is_active) {
            if ($product->is_active) {
                // Notify all followers
                foreach ($product->store->followers as $key => $follower) {
                    $follower->notify(new ProductFromFollowerStoreCreated($product));
                }
            }
        }

        return $this->sendResponse($product->toArray(), 'Product active status changed successfully');
    }
}