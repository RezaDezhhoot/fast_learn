<?php

namespace App\Notifications\Queue;

use App\Services\SMS\SMSChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSMS extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $text , $number;

    public function __construct($text , $number)
    {
        $this->text = $text;
        $this->number = $number;
    }

    public function via($notifiable)
    {
        return [SMSChannel::class];
    }

    public function toSms($notifiable)
    {
        return [
            'text' => $this->text,
            'number' => $this->number
        ];
    }
}
