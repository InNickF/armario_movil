<?php

namespace App\Notifications;

use App\Models\Outfit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OutfitAddedToWishlist extends Notification
{
    use Queueable;


    private $outfit;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Outfit $outfit)
    {
        $this->outfit = $outfit;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'image_url' => $this->outfit->main_image_thumbnail,
            'title' => $this->outfit->name,
            'body' => 'Se ha agregado correctamente los articulos de un outfit a tu wishlist',
            'url' => url('account/wishlist')
        ];
    }
}
