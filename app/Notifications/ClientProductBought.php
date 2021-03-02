<?php

namespace App\Notifications;

use App\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientProductBought extends Notification
{
    use Queueable;



    private $product;
    private $title = 'Producto comprado';
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->body = 'Has comprado el producto ' . $this->product->name;
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
            'image_url' => $this->product->main_image_thumbnail,
            'title' => $this->title,
            'body' => $this->body,
            'url' => url('account/orders')
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
            'click_action' => url('account/orders') // Optional
        ])->data([
            'foo' => 'bar' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }
}
