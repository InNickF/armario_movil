<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\UserStore;
use App\Models\ShippingOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSold extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $store;
    public $guia;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, UserStore $store, ShippingOrder $guia)
    {
        $this->order = $order;
        $this->store = $store;
        $this->guia = $guia;
        $this->subject = '¡Has obtenido una venta!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->markdown('emails.stores.order-sold')->subject($this->subject);

        if ($this->guia->provider == 'Urbano') {
            $mail->attach(public_path() . '/storage/pdf/shipping_orders/shipping_order_' . $this->guia->tracking_number . '.pdf', [
                'as' => 'guia_electronica_' . $this->guia->tracking_number . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
        // ->from('notificaciones@armariomovil.com')
        // ->replyTo('notificaciones@armariomovil.com');
    }
}