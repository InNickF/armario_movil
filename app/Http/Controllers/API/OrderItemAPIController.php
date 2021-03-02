<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class OrderItemAPIController extends Controller
{
    public function track($id)
    {
        $item = OrderItem::find($id);
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

        if ('Glovo' == $item->shipping_provider) {
            $tracking = $item->getTrackingResults();

            if (is_array($tracking) && isset($tracking['error'])) {
                \Log::error('Error tracking');
                \Log::error($tracking['error']);

                return $this->sendError($tracking['error']);
            }
        }

        return $this->sendResponse($tracking, 'Tracking obtenido exitosamente');
    }
}