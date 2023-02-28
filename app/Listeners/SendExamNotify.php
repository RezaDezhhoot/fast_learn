<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\QuizEnum;
use App\Events\ExamEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SendExamNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    /**
     * Handle the event.
     *
     * @param  \App\Events\ExamEvent  $event
     * @return void
     */
    public function handle(ExamEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $raw_text = match ($event->transcript->result) {
            QuizEnum::REJECTED => $SettingRepository->getRow('exam_rejected'),
            QuizEnum::PASSED => $SettingRepository->getRow('exam_passed'),
            default => null,
        };
        if (!empty($raw_text)){
            $text = custom_text('exams',$raw_text,[
                $event->transcript->quiz->name,$event->transcript->score,$event->transcript->quiz->total_score,$event->transcript->quiz->minimum_score
            ]);
            $subject_label = 'نتیجه ازمون';
            app(NotificationRepositoryInterface::class)
                ->send($event->transcript->user, NotificationEnum::QUIZ, $subject_label, $text, 'emails.event', $event->transcript->id,
                    [
                        'text' => $text,
                        'name' => $SettingRepository->getRow('name'),
                    ]
                );
        }
    }
}
