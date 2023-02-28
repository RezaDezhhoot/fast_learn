<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Events\RegisterEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SendRegisterNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisterEvent  $event
     * @return void
     */
    public function handle(RegisterEvent $event): void
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $raw_text =  $SettingRepository->getRow('auth_register');
        if (!empty($raw_text))
        {
            $text = custom_text('auth',$raw_text,[
                $event->user->name,$event->user->status_label
            ]);

            $subject_label = 'شروع دوره جدید';

            app(NotificationRepositoryInterface::class)
                ->send($event->user, NotificationEnum::AUTH, $subject_label, $text, 'emails.register', $event->user->id,
                [
                    'text' => $text,
                    'user'=> $event->user,
                    'name' => $SettingRepository->getRow('name')
                ]
            );
        }
    }
}
