<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\QuizEnum;
use App\Events\ExamEvent;
use App\Mail\ExamMail;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
            $send_type = $SettingRepository->getRow('send_type');
            $text = str_replace(array_keys($SettingRepository::variables()['exams']),
                [$event->transcript->quiz->name,$event->transcript->score,$event->transcript->quiz->total_score,$event->transcript->quiz->minimum_score],
                $raw_text);

            try {
                if ($send_type == 'email' || empty($send_type))
                    Mail::to($event->transcript->user->email)->send(new ExamMail($text));
                elseif ($send_type == 'sms')
                    $SendRepository->sendSMS($text,$event->transcript->user->phone);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }

            $SendRepository->sendNOTIFICATION($text,$event->transcript->user->id,NotificationEnum::QUIZ,$event->transcript->id);
        }
    }
}
