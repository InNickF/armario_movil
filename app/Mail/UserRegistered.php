<?php

namespace App\Mail;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var User
     */
    public $user;
    public $subject;
    public $categories;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->subject = '¡Hola '.$this->user->first_name. ', bienvenido a Armario Móvil!';
        $this->categories = Category::parents()->get();
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.registered')
                     ->subject($this->subject);
                    //  ->from('info@armariomovil.com')
                    //  ->replyTo('info@armariomovil.com');
                   
    }
}
