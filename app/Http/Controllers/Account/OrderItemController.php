<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function show($id)
    {
        $item = OrderItem::with('product_variant.product.store.address')->with('order.shipping_address')->find($id);
        $tracking = null;

        if (!$item) {
            abort(404);
        }

        if (!auth()->user()->isA('super-user')) {
            if ($item->order->user_id != auth()->user()->id) {
                if (empty($item->order->getItemsByStore(auth()->user()->store->id))) {
                    abort(403);
                }
            }
        }

        // if ('Glovo' == $item->shipping_provider) {
        //     $tracking = $item->getTrackingResults();

        //     if (is_array($tracking) && isset($tracking['error'])) {
        //         \Log::error('Error tracking');
        //         \Log::error($tracking['error']);
        //         alert()->info('Error al obtener datos de tracking');

        //         return redirect(url('account/orders'));
        //     }
        // }

        return view('account.tracking.show', compact('item', 'tracking'));
    }
}