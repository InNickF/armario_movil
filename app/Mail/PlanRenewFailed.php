<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlanRenewFailed extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;
    public $subscription;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $plan, $subscription)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.plans.renew-failed');
    }
}
