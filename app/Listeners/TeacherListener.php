<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\TeacherEnum;
use App\Events\TeacherEvent;
use App\Mail\EventMail;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TeacherListener
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
     * @param  \App\Events\TeacherEvent  $event
     * @return void
     */
    public function handle(TeacherEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $SendRepository = app(SendRepositoryInterface::class);
        $raw_text = match ($event->request->status) {
            TeacherEnum::APPLY_CONFIRMED => $SettingRepository->getRow('teacher_apply_confirm'),
            TeacherEnum::APPLY_REJECTED => $SettingRepository->getRow('teacher_apply_reject'),
            default => null,
        };

        if (!empty($raw_text)){
            $send_type = $SettingRepository->getRow('send_type');
            $text = str_replace(array_keys($SettingRepository::variables()['teacher']), [$event->request->user->name,$event->request->id], $raw_text);

            try {

                if ($send_type == 'email')
                    Mail::to($event->request->user->email)->send(new EventMail('درخواست مدرس',$text));
                elseif ($send_type == 'sms')
                    $SendRepository->sendSMS($text,$event->request->user->phone);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            $SendRepository->sendNOTIFICATION($text,$event->request->user->id,NotificationEnum::TEACHER,$event->request->id);
        }
    }
}
