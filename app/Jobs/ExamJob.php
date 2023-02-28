<?php

namespace App\Jobs;

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
    public $transcript , $answers , $transcriptRepository;
    public function __construct($transcript , $answers = [])
    {
        $this->transcript = $transcript;
        $this->answers = $answers;
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
    }

    protected function start()
    {
        $this->transcript->result = QuizEnum::ON_PROCESSING;
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
        foreach ($this->answers as $key => $item) {
            $question = app(QuestionRepositoryInterface::class)->findByPK($key);
            if ($question->true_choice->id == $item)
                $user_score = $user_score + $question->score;
            else {
                $choice_percent = $question->choices->where('id',$item)->first()->score;
                $user_score = $user_score + $question->score * ($choice_percent/100);
            }
            Session::forget("question{$this->transcript->id}{$question->id}");
        }
        $this->transcript->score = $user_score;
        try {
            DB::beginTransaction();
            if ($user_score >= $min_score) {
                $this->transcript->result = QuizEnum::PASSED;
                $certificate_id = !empty($quiz->certificate) ?
                    $quiz->certificate->id : null;
                if (!is_null($certificate_id)) {
                    app(UserRepositoryInterface::class)->submit_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                    $this->transcript->certificate_date = Jalalian::now()->format('Y/m/d');
                    $this->transcript->certificate_code = Auth::id().$this->transcript->id.rand(1234,56789);
                }
            } else
                $this->transcript->result = QuizEnum::REJECTED;

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
    }
}
