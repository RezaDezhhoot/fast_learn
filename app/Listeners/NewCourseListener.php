<?php

namespace App\Listeners;

use App\Enums\CourseEnum;
use App\Enums\NotificationEnum;
use App\Events\NewCourseEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

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
        $raw_text = match ($event->course->status) {
            CourseEnum::NEW_COURSE_ACCEPTED => $SettingRepository->getRow('new_course_accepted'),
            CourseEnum::NEW_COURSE_REJECTED => $SettingRepository->getRow('new_course_rejected'),
            default => null,
        };

        if (!empty($raw_text)){
            $text = custom_text('new_course',$raw_text,[
                $event->course->title,$event->course->user->name,$event->course->level_label
            ]);
            $subject_label = 'شروع دوره جدید';
            app(NotificationRepositoryInterface::class)
                ->send($event->course->user, NotificationEnum::TEACHER, $subject_label, $text, 'emails.event', $event->course->id,
                [
                    'text' => $text,
                    'name' => $SettingRepository->getRow('name'),
                    'subject' => $subject_label,
                ]
            );
        }
    }
}
