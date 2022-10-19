<?php

namespace App\Listeners;

use App\Enums\CourseEnum;
use App\Enums\NotificationEnum;
use App\Events\NewCourseEvent;
use App\Mail\EventMail;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewCourseListener
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
     * @param  \App\Events\NewCourseEvent  $event
     * @return void
     */
    public function handle(NewCourseEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $SendRepository = app(SendRepositoryInterface::class);
        $raw_text = match ($event->course->status) {
            CourseEnum::NEW_COURSE_ACCEPTED => $SettingRepository->getRow('new_course_accepted'),
            CourseEnum::NEW_COURSE_REJECTED => $SettingRepository->getRow('new_course_rejected'),
            default => null,
        };

        if (!empty($raw_text)){
            $send_type = $SettingRepository->getRow('send_type');
            $text = str_replace(array_keys($SettingRepository::variables()['new_course']),
                [$event->course->title,$event->course->user->name,$event->course->level_label], $raw_text);

            try {
                if ($send_type == 'email')
                    Mail::to($event->course->user->email)->send(new EventMail('شروع دوره جدید',$text));
                elseif ($send_type == 'sms')
                    $SendRepository->sendSMS($text,$event->course->user->phone);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            $SendRepository->sendNOTIFICATION($text,$event->course->user->id,NotificationEnum::TEACHER,$event->course->id);
        }
    }
}
