<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Answer;
use App\user;

class QuestionAnswered extends Mailable
{
    use Queueable, SerializesModels;
    public $answer;
    public $subject;


    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
        $this->subject = 'La tienda ' . $this->answer->question->product->store->name . ' ha respondido tu pregunta';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.answers.created')->subject($this->subject);
        //              ->from('notificaciones@armariomovil.com')
        //              ->replyTo('notificaciones@armariomovil.com');
    }
}