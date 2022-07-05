<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\QuizEnum;
use App\Events\ExamEvent;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $SendRepository = app(SendRepositoryInterface::class);
        $raw_text = match ($event->transcript->result) {
            QuizEnum::REJECTED => $SettingRepository->getRow('exam_rejected'),
            QuizEnum::PASSED => $SettingRepository->getRow('exam_passed'),
            default => null,
        };

        if (!empty($raw_text)){
            $text = str_replace(array_keys($SettingRepository::variables()['exams']),
                [$event->transcript->quiz->name,$event->transcript->score,$event->transcript->quiz->total_score,$event->transcript->quiz->minimum_score],
                $raw_text);
            $SendRepository->sendSMS($text,$event->transcript->user->phone);
            $SendRepository->sendNOTIFICATION($text,$event->transcript->user->id,NotificationEnum::QUIZ,$event->transcript->id);
        }
    }
}
