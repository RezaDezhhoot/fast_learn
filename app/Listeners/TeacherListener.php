<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\TeacherEnum;
use App\Events\TeacherEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

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
        $raw_text = match ($event->request->status) {
            TeacherEnum::APPLY_CONFIRMED => $SettingRepository->getRow('teacher_apply_confirm'),
            TeacherEnum::APPLY_REJECTED => $SettingRepository->getRow('teacher_apply_reject'),
            default => null,
        };

        if (!empty($raw_text)){
            $text = custom_text('teacher',$raw_text,[
                $event->request->user->name,$event->request->id
            ]);
            $subject_label = 'درخواست مدرس';
            app(NotificationRepositoryInterface::class)
                ->send($event->request->user, NotificationEnum::TEACHER, $subject_label, $text, 'emails.event', $event->request->id,
                    [
                        'text' => $text,
                        'name' => $SettingRepository->getRow('name'),
                        'subject' => $subject_label,
                    ]
                );
        }
    }
}
