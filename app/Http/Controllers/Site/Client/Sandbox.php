<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
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
    public $question = [] , $choose , $quiz;
    public array $answers = [] ;

    public $question_count;

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
        SEOMeta::setTitle($this->settingRepository->getRow('title'));
        $this->choose = [
            '1' => [
                'اوباما', 'کارتر' , 'هری ترومن' , 'ترامپ'
            ],
            '2' => [
                'نیما یوشیج' , 'سهراب سپهری' , 'فروغ فرخزاد' , 'فریدون مشیری'
            ],
            '3' => [
                'سیب' , 'زیتون' , 'انار' , 'کاج'
            ],
            '4' => [
                'دایملر' , 'دایملر' , 'الیشا اوتیس' , 'جورج وستینگهاوس'
            ]
        ];
        $this->quiz = \App\Models\Quiz::query()->first();
        $this->question_count = SandboxQuestion::query()->count();
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => now()->addMinutes($this->quiz->time)->timestamp() ?? '']);
    }

    public function undo($key)
    {
        unset($this->answers[$key]);
    }


    public function render()
    {
        $question = SandboxQuestion::query()->paginate(1);
        return view('site.client.sandbox',get_defined_vars())->extends('site.layouts.site.site');
    }
}
