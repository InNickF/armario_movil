<?php

namespace App\Notifications;

use App\Mail\OrderDelivered;
use App\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class ClientOrderMarkedAsDelivered extends Notification
{
    use Queueable;



    private $order;
    private $title = 'Pedido recibido';
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->body = 'Tu pedido ha sido entregado';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm', 'mail'];
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
            'image_url' => $this->order->items()->first()->product_variant->product->main_image_thumbnail,
            'title' => $this->title,
            'body' => $this->body,
            'url' => url('account/orders')
        ];
    }

    public function toMail($notifiable)
    {
        return (new OrderDelivered($this->order))->to($notifiable->email);
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
