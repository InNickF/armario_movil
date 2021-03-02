<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminPaymentRequestCreated extends Mailable
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
        $this->subject = 'Un pago inmediato ha sido solicitado';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admins.payment_request_created')->subject($this->subject);
                    // ->from('servicios@armariomovil.com')
                    // ->replyTo('servicios@armariomovil.com');
    }
}
