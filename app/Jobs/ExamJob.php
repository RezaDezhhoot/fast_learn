<?php

namespace App\Jobs;

use App\Enums\QuestionEnum;
use App\Enums\QuizEnum;
use App\Events\ExamEvent;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\Jalalian;

class ExamJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $transcript , $transcriptRepository , $needs_teacher , $userRepository;
    public function __construct($transcript , $needs_teacher = false)
    {
        $this->transcript = $transcript;
        $this->needs_teacher = $needs_teacher;
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    protected function start()
    {
        $this->transcript->result = QuizEnum::ON_PROCESSING;
        $this->transcriptRepository->save($this->transcript);
    }

    public function needsTeacher()
    {
        $this->transcript->result = QuizEnum::PROCESS_BY_TEACHER;
        $this->transcriptRepository->save($this->transcript);
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->start();

        $quiz = $this->transcript->quiz;
        $min_score = $quiz->minimum_score;
        $user_score = 0;
        if (! $this->needs_teacher) {
            foreach ($this->transcript->answers as $item) {
                $user_score = $user_score + ($item->score_received ?? 0);
                Session::forget("question{$this->transcript->id}{$item->question_id}");
            }
            $this->transcript->score = $user_score;
            try {
                DB::beginTransaction();
                $certificate_id = !empty($quiz->certificate) ?
                    $quiz->certificate->id : null;
                if ($user_score >= $min_score) {
                    $this->transcript->result = QuizEnum::PASSED;
                    if (!is_null($certificate_id)) {
                        app(UserRepositoryInterface::class)->submit_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                        $this->transcript->certificate_date = Jalalian::now()->format('Y/m/d');
                        $this->transcript->certificate_code = Auth::id().$this->transcript->id.rand(1234,56789);
                    }
                } else {
                    if (!is_null($certificate_id) and
                        $this->userRepository->has_certificate($this->transcript->user,$certificate_id,$this->transcript->id)) {
                        $this->userRepository->reclaiming_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                        $this->transcript->certificate_date = null;
                        $this->transcript->certificate_code = null;
                    }
                    $this->transcript->result = QuizEnum::REJECTED;
                }

                $this->transcriptRepository->save($this->transcript);
                ExamEvent::dispatch($this->transcript);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                $this->transcript->result = QuizEnum::ERROR;
                $this->transcript->error_message = $e->getMessage();
                $this->transcriptRepository->save($this->transcript);
            }
        } else {
            $this->needsTeacher();
        }
    }
}
