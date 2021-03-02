<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\UserStore;

class AuctionAccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $store;
    public $subject;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserStore $store)
    {
        $this->store = $store;
        $this->subject = '¡'.$this->store->name.' ha aceptado tu oferta, felicitaciones!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auctions.auction-accepted')->subject($this->subject);
        // ->from('notificaciones@armariomovil.com')
        //             ->replyTo('notificaciones@armariomovil.com');
    }
}

