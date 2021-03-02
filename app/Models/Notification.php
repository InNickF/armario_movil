<?php

namespace App\Models;

use Illuminate\Notifications\Notification as BaseNotification;

class Notification extends BaseNotification
{
    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->invoice->id,
            'amount' => $this->invoice->amount,
        ];
    }
}
