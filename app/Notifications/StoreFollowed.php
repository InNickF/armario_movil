<?php

namespace App\Notifications;

use App\User;
use App\Models\UserStore;
use Illuminate\Bus\Queueable;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StoreFollowed extends Notification
{
    use Queueable;


    private $store;
    private $user;
    private $title = 'Tienes un nuevo seguidor';
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserStore $store, User $user)
    {
        $this->store = $store;
        $this->user = $user;
        $this->body = 'El usuario ' . $this->user->full_name . ' ha comenzado a seguir a tu tienda';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm'];
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
            'image_url' => $this->store->logo_image_thumbnail,
            'title' => $this->title,
            'body' => $this->body,
            'url' => $this->store->url
        ];
    }


    public function toFcm($notifiable)
    {
        $message = new FcmMessage();
        $message->content([
            'title'        => $this->title,
            'body'         => $this->body,
            'sound'        => '', // Optional 
            'icon'         => asset('images/icons/am-push-icon.png'), // Optional
            'click_action' => $this->store->url // Optional
        ])->data([
            'foo' => 'bar' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }
}
