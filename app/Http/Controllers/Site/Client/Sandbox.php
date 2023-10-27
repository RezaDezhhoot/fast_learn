<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Question;
use App\Models\SandboxQuestion;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;
use Morilog\Jalali\Jalalian;

class Sandbox extends BaseComponent
{
    use WithPagination;

    public mixed $user;
    public  $choose , $quiz;
    public array $answers = [] ;

    public $question_count , $quiz_id;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->questionRepository = app(QuestionRepositoryInterface::class);
    }

    public function mount($id)
    {
        $this->quiz_id = $id;
        SEOMeta::setTitle($this->settingRepository->getRow('title'));
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => now()->addMinutes(10)->format('Y-m-d H:i:s') ?? '']);
    }

    public function undo($key)
    {
        unset($this->answers[$key]);
    }

    private function getAnswers()
    {
        $this->answers = $this->transcript->answers->pluck('choice_id','question_id')->toArray();
    }

    public function finish()
    {
        $quiz = \App\Models\Quiz::query()
            ->has('questions')
            ->findOrFail($this->quiz_id);
        $min_score = $quiz->minimum_score;
        $user_score = 0;
        foreach ($this->answers as $key => $item) {
            $question = Question::findOrFail($key);
            if ($question->true_choice->id == $item)
                $user_score = $user_score + $question->score;
            else {
                $choice_percent = $question->choices->where('id',$item)->first()->score;
                $user_score = $user_score + $question->score * ($choice_percent/100);
            }
        }
        if ($user_score >= $min_score) {
            $this->emit('successQuiz',[
                'score' => $user_score,
                'min_score' => $min_score,
                'total_score' => $quiz->total_score
            ]);
        } else {
            $this->emit('rejectQuiz',[
                'score' => $user_score,
                'min_score' => $min_score,
                'total_score' => $quiz->total_score
            ]);
        }
    }

    public function render()
    {
        $question = \App\Models\Quiz::query()
            ->has('questions')
            ->findOrFail($this->quiz_id)->questions()->inRandomOrder((int)(str_replace([':','.'],'','192.168.1.1')/1000))->paginate(1);

        $this->question_count =\App\Models\Quiz::query()
            ->has('questions')
            ->findOrFail($this->quiz_id)->questions()->count();


        return view('site.client.sandbox',['question'=>$question])->extends('site.layouts.site.site');
    }
}
