<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $store;
     public $paymentRequestId;
     public $date;
     public $subject;

    public function __construct($store, $paymentRequestId, $date)
    {
        $this->store = $store;
        $this->paymentRequestId = $paymentRequestId;
        $this->date = $date;
        $this->subject = 'Tu pago inmediato ha sido solicitado';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.stores.payment_request_created')->subject($this->subject);
                    // ->from('servicios@armariomovil.com')
                    // ->replyTo('servicios@armariomovil.com');
    }
}
