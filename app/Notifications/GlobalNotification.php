<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GlobalNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $message1, $message2 = null, $message3 = null)
    {
        $this->data['name']           = $data->firstname.' '.$data->lastname;
        $this->data['message1']       = $message1;
        $this->data['message2']       = $message2;
        $this->data['message3']       = $message3;
        $this->data['subject']        = $subject;
        $this->data['site']           = 'Parhit Properties';
        $this->data['company_email']  = 'admin@gmail.com';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'email.global', ['data' => $this->data]
        )
        ->subject($this->data['subject']);
    }
}
