<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Events\AuthenticationEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;


class SendAuthenticationNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AuthenticationEvent $event
     * @return void
     */
    public function handle(AuthenticationEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $raw_text =  $SettingRepository->getRow('auth_login');
        if (!empty($raw_text))
        {
            $text = custom_text('auth',$raw_text,[
                $event->user->name,$event->user->status_label
            ]);
            $subject_label ='ورود به ناحیه کاربری';
            app(NotificationRepositoryInterface::class)
                ->send($event->user, NotificationEnum::AUTH, $subject_label, $text, 'emails.login', $event->user->id,
                    [
                        'text' => $text,
                        'name' => $SettingRepository->getRow('name'),
                    ]
                );
        }
    }
}
