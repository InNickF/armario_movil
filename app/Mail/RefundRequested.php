<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefundRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $input;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $user, $input)
    {
        $this->order = $order;
        $this->user = $user;
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.refund-requested');
    }
}
