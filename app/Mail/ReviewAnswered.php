<?php

namespace App\Mail;

use App\Models\ReviewAnswer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewAnswered extends Mailable
{
    use Queueable, SerializesModels;
    public $answer;
  

    public function __construct(ReviewAnswer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reviews.answered');
    }
}
