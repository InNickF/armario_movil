<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class SubscribedToCloset extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->subject = '¡Tu suscripción al plan Closet se ha realizado exitosamente!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.plans.closet')->subject($this->subject);
        // ->from('notificaciones@armariomovil.com')
        //             ->replyTo('notificaciones@armariomovil.com');
    }
}
