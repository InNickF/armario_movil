<?php

namespace App\Models;

use App\Models\Order;
use Eloquent as Model;
use App\Services\GlovoService;
use App\Services\UrbanoService;


class OrderItem extends Model
{

    public $table = 'order_items';


    public $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'unit_price_subtotal',
        'unit_price_final',
        'sum_price_subtotal',
        'sum_price_final',
        'tracking_number',
        'status',
        'commission_percentage',
        'commission_price',
        'vat_price',
        'coupon_id',
        'coupon_discount',
        'earning',
        'conditions',
        'is_valid_store_bill',
        'is_paid_earning',
        'admin_comment',
        'shipping_order_id',
        'shipping_provider'
    ];


    public $appends = [
        'tracking_url'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'order_id' => 'integer',
        'product_variant_id' => 'integer',
        'quantity' => 'integer',
        'sum_price_subtotal' => 'float',
        'sum_price_final' => 'float',
        'tracking_number' => 'string',
        'status' => 'string',
        'price_subtotal' => 'float',
        'price_final' => 'float',
        'earning' => 'float',
        'commission_percentage' => 'float',
        'commission_price' => 'float',
        'vat_price' => 'float',
        'coupon_id' => 'integer',
        'coupon_discount' => 'float',
        'conditions' => 'array',
        'is_valid_store_bill' => 'boolean',
        'is_paid_earning' => 'boolean',
        'shipping_order_id' => 'integer',
        'shipping_provider' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'product_variant_id' => 'required',
        'quantity' => 'required',
        'sum_price_subtotal' => 'required',
        'sum_price_final' => 'required',
        'commission_percentage' => 'required',
        'commission_price' => 'required',
        'coupon_discount' => 'required',
        'unit_price_subtotal' => 'required',
        'unit_price_final' => 'required',
        'vat_price' => 'required',
        'earning' => 'required',
    ];


    public $with = ['review', 'product_variant'];

    public function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }


    public function review()
    {
        return $this->morphOne('App\Models\Review', 'reviewable');
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function shipping_order()
    {
        return $this->belongsTo(ShippingOrder::class);
    }


    public function getTrackingUrl()
    {
        return url('account/tracking/') . '/' . $this->id;
    }

    public function getTrackingUrlAttribute()
    {
        return $this->getTrackingUrl();
    }

    public function getTrackingResults()
    {
        if ($this->shipping_order && $this->shipping_order->provider == 'Urbano') {
            $urbano = new UrbanoService();
            return $urbano->track($this->shipping_order->tracking_number);
        }

        // TODO: Change to GLOVO
        if ($this->shipping_order && $this->shipping_order->provider == 'Glovo') {
            $glovo = new GlovoService();
            return $glovo->track($this->shipping_order->tracking_number);
        }

        return [];
    }

    public function getColorAttribute()
    {
        switch ($this->status) {
            case 'Pendiente':
                return '#f7e3cbff';
                break;

            case 'En camino':
                return '#f7e3cbff';
                break;

            case 'Entregado':
                return '#d8f8ef';
                break;

            case 'Devuelto':
                return '#ffaaaa';
                break;

            default:
                return '#f7e3cbff';
                break;
        }
    }
}
