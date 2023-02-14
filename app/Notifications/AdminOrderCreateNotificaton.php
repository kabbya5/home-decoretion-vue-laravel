<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderCreateNotificaton extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;


    public function __construct($order)
    {
        $this->order = $order;
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
            ->line( $this->order->shipping->name)
            ->line( $this->order->shipping->email)
            ->line( $this->order->shipping->phone)
            ->line( $this->order->shipping->address)
            ->line( $this->order->shipping->district)
            ->line( $this->order->shipping->comment)
            ->action('View order', $url)
            ->line('Message was Sent About' .Carbon::now()->format('Y-m-d'));
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
            'order_slug' => $this->order->slug,
            'order_user_id' => $this->order->user_id,
            'order_message' => $this->order->shipping->comment,
        ];
    }
}
