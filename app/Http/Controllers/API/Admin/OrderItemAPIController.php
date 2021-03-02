<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\OrderItem;

/**
 * Class OrderItemController
 * @package App\Http\Controllers\API
 */

class OrderItemAPIController extends \App\Http\Controllers\Controller
{
    public function update($id)
    {
        $item = OrderItem::find($id);

        if (empty($item)) {
            return $this->sendError('Ítem no encontrado');
        }

        $item->update(request()->all());

       return $this->sendResponse($item->toArray(), 'Se ha actualizado el ítem');
    }
}
