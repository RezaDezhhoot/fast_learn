<?php

namespace App\Services\Notification;

use App\Repositories\Interfaces\SendRepositoryInterface;
use Illuminate\Notifications\Notification;

class NotificationChannel
{
    public function send($notifiable, Notification $notification )
    {
        $data = $notification->toNotification($notifiable);
        return
            app(SendRepositoryInterface::class)->sendNOTIFICATION($data['text'],$data['user_id'],$data['subject'],$data['subject_id']);
    }
}
