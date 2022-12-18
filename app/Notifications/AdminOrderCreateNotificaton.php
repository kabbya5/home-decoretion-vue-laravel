<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderCreateNotificaton extends Notification 
{
    use Queueable;

    private $order;
    private $shipping_data;
    private $carts_count;


    public function __construct($input,$data,$carts)
    {
        $this->order = $input;
        $this->shipping_data = $data;
        $this->carts = $carts->count();
    }


    public function via($notifiable)
    {
        return ['mail','database'];
    }

  
    public function toMail($notifiable)
    {
        $url = url('/admin/order/'.$this->order['slug']);
        $siteSettingEmail = SiteSetting::first()->company_email;
        return (new MailMessage)        
            ->from($siteSettingEmail)
            ->subject('Great News, You got An Order')
            ->greeting($this->order['slug'] . $this->order['subtotal'])
            ->line('Shipping Detail')
            ->line( $this->shipping_data['name'])
            ->line( $this->shipping_data['email'])
            ->line( $this->shipping_data['phone'])
            ->line( $this->shipping_data['address'])
            ->line( $this->shipping_data['district'])
            ->line( $this->shipping_data['comment'])
            ->action('View order', $url)
            ->line('Message was Sent About' .Carbon::now());
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
            'order_slug' => $this->order['slug'],
            'order_user_id' => $this->order['user_id'],
            'order_message' => $this->shipping_data['comment'],
        ];
    }
}
