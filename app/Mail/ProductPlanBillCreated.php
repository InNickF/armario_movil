<?php

namespace App\Mail;

use App\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductPlanBillCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $subject;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product, Transaction $transaction)
    {
        $this->product = $product;
        $this->transaction = $transaction;
        $this->subject = 'Hola ' . $this->product->store->user->first_name . ', tu factura ha sido generada';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.products.bill-created')->subject($this->subject);
    }
}