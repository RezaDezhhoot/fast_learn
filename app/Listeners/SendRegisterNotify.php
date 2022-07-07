<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\UserEnum;
use App\Events\RegisterEvent;
use App\Mail\AuthenticationMail as AuthMailer;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

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
        $SendRepository = app(SendRepositoryInterface::class);
        $raw_text =  $SettingRepository->getRow('auth_register');
        if (!empty($raw_text))
        {
            $text = str_replace(array_keys($SettingRepository::variables()['auth']),
                [$event->user->name,$event->user->status_label], $raw_text);
            $send_type =$SettingRepository->getRow('send_type');

            try {
                if ($send_type == 'email')
                    Mail::to($event->user->email)->send(new AuthMailer($event->user,$text,UserEnum::REGISTER_EVENT));
                elseif ($send_type == 'sms')
                    $SendRepository->sendSMS($text,$event->user->phone);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }

            $SendRepository->sendNOTIFICATION($text,$event->user->id,NotificationEnum::AUTH,$event->user->id);
        }
    }
}
