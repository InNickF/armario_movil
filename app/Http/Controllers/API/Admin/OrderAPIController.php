<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Notifications\OrderMarkedAsDelivered;
use App\Notifications\ClientOrderMarkedAsDelivered;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends \App\Http\Controllers\Controller
{
    public function refund($id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            return $this->sendError('Pedido no encontrado');
        }

        if ($order->can_refund == false) {
            return $this->sendError('Pedido no califica para ser reembolsado');
        }

        $refunded = $order->refund();

        if (isset($refunded['error'])) {
            $message = $refunded['error'];
            // $this->returnProductsToStock();

            return $this->sendError('No se ha procesado el reembolso: ' . $message);
        }

        return $this->sendResponse($order->toArray(), 'Se ha procesado el reembolso');
    }


    public function update($id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            return $this->sendError('Pedido no encontrado');
        }

        $input = request()->all();
        $order->update($input);

        return $this->sendResponse($order->toArray(), 'Se ha actualizado el pedido');
    }

    public function markAsDelivered($id)
    {
        $order = Order::with(['user', 'items.product_variant.product.store'])->find($id);
        $status = OrderStatus::whereSlug('completed')->first();

        if (!$status) {
          return $this->sendError('Error al cargar status');
        }

        if (!$order) {
          return $this->sendError('Pedido no encontrado');
        }


        $products = $order->items->map(function ($item) {
            return $item->product_variant->product;
        })->unique();
        foreach ($products as $key => $product) {
            // Notify to Store Owner *per product*
            $product->store->user->notify(new OrderMarkedAsDelivered($product, $order->user));
        }

        foreach ($order->items as $key => $item) {
            $item->status = 'Entregado';
            $item->save();
        }

        // Notify User Client
        $order->user->notify(new ClientOrderMarkedAsDelivered($order));

        $order->status_id = $status->id;
        $order->save();

        return $this->sendResponse($order->toArray(), 'Se ha actualizado el pedido');
    }
}
