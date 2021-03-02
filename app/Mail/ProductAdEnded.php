<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserStore;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductAdEnded extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->subject = 'Tu anuncio del producto '.$this->product->name. ', ha finalizado';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.plans.product_ad_ended')->subject($this->subject);
                    // ->from('notificaciones@armariomovil.com')
                    // ->replyTo('notificaciones@armariomovil.com');
        
    }
}