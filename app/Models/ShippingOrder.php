<?php

namespace App\Models;

use App\Models\Order;
use Eloquent as Model;
use App\Models\OrderItem;
use App\Models\UserStore;
use App\Jobs\SendOrderSoldEmail;

/**
 * Class ShippingOrder
 * @package App\Models
 * @version August 23, 2019, 9:57 am -05
 *
 * @property integer order_id
 * @property float price
 * @property string code
 * @property string status
 * @property string tracking_number
 * @property string tracking_history_json
 * @property string provider_order_json
 */
class ShippingOrder extends Model
{

    public $table = 'shipping_orders';



    public $fillable = [
        'order_id',
        'store_id',
        'code',
        'price',
        'status',
        'tracking_number',
        'tracking_history_json',
        'provider',
        'provider_order_json'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'order_id' => 'integer',
        'price' => 'float',
        'code' => 'string',
        'status' => 'string',
        'provider' => 'string',
        'tracking_number' => 'string',
        'tracking_history_json' => 'array',
        'provider_order_json' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(UserStore::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }



    public function sendOrderSoldEmail($store = null)
    {
        if ($this->provider == 'Urbano') {

            $bar = app()->make('BarCode');
            $barcode = [
                'text' => $this->tracking_number,
                'size' => 80,
                'orientation' => 'horizontal',
                'code_type' => 'code39',
                'print' => true,
                'sizefactor' => 1,
                'filename' => 'barcode_' . $this->tracking_number . '.jpeg',
                // 'filepath' => public_path('barcode_' . $this->tracking_number . '.jpeg'),
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

            \Log::info('Barcode generated');

            \Log::info($barcontent);
            // // Move to public to fix bug when called from cli was creating in root of project
            // rename(base_path($barcontent), public_path($barcontent));
            // Save guia electronica as PDF
            $pdf = \PDF::setOption('images', true)->loadView('pdf.shipping_order', ['shipping_order' => $this, 'barcontent' => $barcontent]);
            // save file
            $targetPath = public_path('storage/pdf/shipping_orders/shipping_order_' . $this->tracking_number . '.pdf');
            $pdf->save($targetPath);
            \Log::info('PDF shipping_orders saved in ' . $targetPath);

            // Notify store via email only
            \Log::info('Enviando GUIA URBANO a tienda');

            // Enqueue this to prevent too many per second block
            \Log::info('Creando tarea de envío para tienda ' . $this->store_id . ': ' . $this->store->name);
            SendOrderSoldEmail::dispatch($this->order, $this->store, $this);
            // Storage::setVisibility('pdf/shipping_orders/shipping_order_' . $guia->tracking_number . '.pdf', 'private'); // * Make private after sending, no one else should see it
        }

        // TODO: Change to GLOVO in email template
        if ($this->provider == 'Glovo') {
            // Enqueue this to prevent too many per second block
            SendOrderSoldEmail::dispatch($this->order, $store, $this);
        }
    }
}
