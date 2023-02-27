<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\Notification\NotificationChannel;

class SendNotification extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $text , $user_id , $subject , $subject_id;

    public function __construct($text , $user_id , $subject , $subject_id)
    {
        $this->text = $text;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->subject_id = $subject_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [NotificationChannel::class];
    }

    public function toNotification($notifiable)
    {
        return [
            'text' => $this->text,
            'user_id' => $this->user_id,
            'subject' => $this->subject,
            'subject_id' => $this->subject_id
        ];
    }
}
