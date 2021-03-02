<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShippingOrder;
use App\Http\Controllers\Controller;

class ShippingOrderController extends Controller
{
    public function show($id)
    {
        $shipping_order = ShippingOrder::find($id);

        if (!$shipping_order) {
            abort(404);
        }

        if (!auth()->user()->isA('super-user')) {
            abort(403);
        }


        $bar = app()->make('BarCode');
        $barcode = [
            'text' => $shipping_order->tracking_number,
            'size' => 80,
            'orientation' => 'horizontal',
            'code_type' => 'code39',
            'print' => true,
            'sizefactor' => 1,
            'filename' => 'barcode_' . $shipping_order->tracking_number . '.jpeg',
            // 'filepath' => public_path('barcode_' . $shipping_order->tracking_number . '.jpeg'),
        ];


        $barcontent = $bar->barcodeFactory()->renderBarcode(
            $text = $barcode["text"],
            $size = $barcode['size'],
            $orientation = $barcode['orientation'],
            $code_type = $barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar 
            $print = $barcode['print'],
            $sizefactor = $barcode['sizefactor'],
            $filename = $barcode['filename']
        )->filename($barcode['filename']);

        return view('account.shipping_orders.show', compact('shipping_order', 'barcontent'));
    }
}