<?php

namespace App\Notifications;

use App\Mail\ProductAdEnded;
use App\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductPlanExpired extends Notification
{
    use Queueable;



    private $product;
    private $title = 'Anuncio de producto ha finalizado';
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        $this->body = 'El período de anuncio de tu producto ' . $this->product->name . ' ha terminado, pulsa aquí para contratar un nuevo plan';
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
            'image_url' => $this->product->main_image_thumbnail,
            'title' => $this->title,
            'body' => $this->body,
            'url' => url('account/products/' . $this->product->id . '/edit')
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
            'click_action' => url('account/products/' . $this->product->id . '/edit') // Optional
        ])->data([
            'foo' => 'bar' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }


    public function toMail($notifiable)
    {
        return (new ProductAdEnded($this->product))->to($notifiable->email);
    }

}
