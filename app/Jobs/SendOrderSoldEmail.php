<?php

namespace App\Jobs;

use App\Models\Order;
use App\Mail\OrderSold;
use App\Models\UserStore;
use App\Models\ShippingOrder;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;

class SendOrderSoldEmail
{
    use Dispatchable, Queueable;

    protected $order;
    protected $store;
    protected $guia;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, UserStore $store, ShippingOrder $guia)
    {
        $this->order = $order;
        $this->store = $store;
        $this->guia = $guia;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->store->user)->cc([setting('admin_email', 'info@armariomovil.com')])->send(new OrderSold($this->order, $this->store, $this->guia));
    }


    public function failed(Exception $exception)
    {
        \Log::error('SendOrderSoldEmail FAILED:');
        \Log::error($exception);
    }
}