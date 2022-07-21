<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\QuizEnum;
use App\Events\ExamEvent;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChoiceRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Morilog\Jalali\Jalalian;

class Exam extends BaseComponent
{
    use WithPagination;
    public $transcript , $change_choice = 12 , $question_count;
    public array $answers = [];
    public mixed $user;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->questionRepository = app(QuestionRepositoryInterface::class);
    }

    public function mount($token)
    {
        $this->user = auth()->user();
        $this->transcript = $this->transcriptRepository->get([['token',$token]]);
        $this->question_count = $this->transcript->quiz->question_count;
        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'-'.$this->transcript->quiz->name);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        if (!$this->checkTimer()) abort(404);

        $this->getAnswers();
    }
    public function render()
    {
        $question = $this->quizRepository->startQuiz($this->transcript->quiz,$this->transcript->id);
        return view('site.client.exam',['question'=>$question])->extends('site.layouts.site.site');
    }

    private function control_requests($key): bool
    {
        $counts = (int)Session::get("question{$this->transcript->id}{$key}",0);
        if ($counts <= $this->change_choice)
        {
            Session::put("question{$this->transcript->id}{$key}",++$counts);
            Session::save();
        }

        return $counts > $this->change_choice;
    }

    public function updatedAnswers($value,$name)
    {
       if ($this->control_requests(key:$name))
           return $this->emitNotify('کاربر گرامی به علت درخواست های زیاد این سوال برای شما مسدود شد.','warning');

        if (!empty($value)){
            if ($this->checkTimer()) {
                $question = $this->questionRepository->find($name);
                $choice = $question->choices->where('id',$value)->first();
                $this->transcriptRepository->attachAnswer($this->transcript,$question->id ,
                    [
                        'choice_value' => $choice->title ,
                        'true_choice_value' => $question->true_choice->title,
                        'question_score' => $question->score,
                        'score_received' => $question->score * ($choice->score/100),
                        'choice_id' => $value,
                        'question_text' => $question->text,
                    ]
                );

            } else $this->emitNotify('ازمون به اتمام رسیده است','warning');
        }
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => $this->transcript->timer ?? '']);
    }

    public function undo($id)
    {
        if ($this->checkTimer()){
            if (in_array($id,array_keys($this->answers))) {
                unset($this->answers[$id]);
                $this->transcriptRepository->deleteAnswer($this->transcript, [$id]);
            }
        }
        else $this->emitNotify('ازمون به اتمام رسیده است','warning');
    }

    public function finish()
    {
        $this->getAnswers();
        $quiz = $this->transcript->quiz;
        $min_score = $quiz->minimum_score;
        $user_score = 0;
        foreach ($this->answers as $key => $item) {
            $question = $this->questionRepository->findByPK($key);
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
                    $this->userRepository->submit_certificate($this->transcript->user,$certificate_id,$this->transcript->id);
                    $this->transcript->certificate_date = Jalalian::now()->format('Y/m/d');
                    $this->transcript->certificate_code = Auth::id().$this->transcript->id.rand(1234,56789);
                }
            } else
                $this->transcript->result = QuizEnum::REJECTED;

            $this->transcriptRepository->save($this->transcript);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->emitNotify('خطا در هنگام ثبت ازمون','warning');
        }
        try {
            ExamEvent::dispatch($this->transcript);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        redirect()->route('user.quiz',$this->transcript->id);
    }

    private function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make($this->transcript->timer));
        return ((int)$interval->format("%r") >= "" && in_array($this->transcript->result,[
            QuizEnum::PENDING,QuizEnum::SUSPENDED
            ])
        );
    }

    private function getAnswers()
    {
        $this->answers = $this->transcript->answers->pluck('choice_id','question_id')->toArray();
    }
}
