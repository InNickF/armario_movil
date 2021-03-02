<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $link;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $link, $token)
    {
        $this->user = $user;
        $this->link = $link;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.emails.password');
                    // ->from('servicios@armariomovil.com')
                    // ->replyTo('info@armariomovil.com');
    }
}
