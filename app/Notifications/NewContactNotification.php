<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/admin/contact/'.$this->contact['id']);

        return (new MailMessage)
            ->from($this->contact['contact_email'])
            ->subject($this->contact['contact_subject'])
            ->greeting("message from " .$this->contact['contact_name'])
            ->line('phone:'. $this->contact['contact_phone'])
            ->line('email:'. $this->contact['contact_email'])
            ->line('subject:'. $this->contact['contact_subject'])
            ->line('message:' . $this->contact['contact_description'])
            ->action('View Contact', $url)
            ->line('Thank you for using our application!');
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
            'contact_subject' => $this->contact['contact_subject'],
            'user' => $this->contact['user'],
            'contact_message' => $this->contact['contact_description'],
        ];
    }
}
