<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderDelivered extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->subject = 'Hola '.$this->order->user->first_name. ', tu orden ha sido entregada';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.order-delivered')->subject($this->subject);
        // ->from('facturas@armariomovil.com')
        //             ->replyTo('facturas@armariomovil.com');
    }
}
