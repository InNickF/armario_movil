<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserPlanBillCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction)
    {
        $this->user = $user;
        $this->transaction = $transaction;
        $this->subject = 'Hola ' . $this->user->first_name . ', tu factura ha sido generada';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.bill-created')->subject($this->subject);
    }
}