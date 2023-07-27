<?php

namespace App\Http\Controllers\Site\Client;

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
use Livewire\WithPagination;

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

    public function finish()
    {
        redirect()->route('home');
    }

    public function render()
    {
        $question = \App\Models\Quiz::query()
            ->has('questions')
            ->findOrFail($this->quiz_id)->questions()->paginate(1);

        $this->question_count =\App\Models\Quiz::query()
            ->has('questions')
            ->findOrFail($this->quiz_id)->questions()->count();


        return view('site.client.sandbox',['question'=>$question])->extends('site.layouts.site.site');
    }
}
