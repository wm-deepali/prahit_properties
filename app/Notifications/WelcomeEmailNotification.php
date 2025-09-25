<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmailNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($template, $subject, $image)
    {
        $this->data['template'] = $template;
        $this->data['subject']  = $subject;
        $this->data['logo']     = 'http://parhitproperties.com/parhit-2021/public/images/logo.png';
        $this->data['image']    = $image;
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
        try {
          return (new MailMessage)->view(
            'emails.template', ['data' => $this->data]
          )
          ->subject($this->data['subject']);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
