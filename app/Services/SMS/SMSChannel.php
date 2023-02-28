<?php

namespace App\Services\SMS;

use App\Repositories\Interfaces\SendRepositoryInterface;
use Illuminate\Notifications\Notification;

class SMSChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification): void
    {
        $data = $notification->toSms($notifiable);
        app(SendRepositoryInterface::class)->sendSMS($data['text'],$data['number']);
    }
}
