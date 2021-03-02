<?php

namespace App\Mail;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionAskedOnMyProduct extends Mailable
{
    use Queueable, SerializesModels;

    public $question;
    public $subject;
  

    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->subject = 'Has recibido una pregunta sobre un producto de tu tienda';
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.questions.created-store')->subject($this->subject);
                    // ->from('notificaciones@armariomovil.com')
                    // ->replyTo('notificaciones@armariomovil.com');
    }
}
