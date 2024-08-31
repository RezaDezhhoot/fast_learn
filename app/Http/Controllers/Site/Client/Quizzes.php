<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\QuizEnum;
use App\Models\Course;
use App\Models\Transcript;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class Quizzes extends Component
{
    protected $queryString = ['course'];
    public bool $userDetails = false;
    public mixed $user;
    public $course;


    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->user = auth()->user();
        SEOMeta::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->userDetails = !empty($this->user->details);

        if ($this->course) {
            $this->appendQuiz($this->course);
        }
    }

    private function appendQuiz($course)
    {
        $course = Course::query()->findOrFail($course);
        if ($course->quiz) {
            if (Transcript::query()->where([
                ['user_id','=',$course->quiz->id],
                ['quiz_id','=',auth()->id()],
                ['course_id','=',$course->id],
            ])->count() < $course->quiz->enter_count) {
                $transcript = Transcript::query()->create([
                    'user_id' => auth()->id(),
                    'quiz_id' => $course->quiz->id,
                    'course_id' => $course->id,
                    'result' => QuizEnum::PENDING,
                    'course_data' => json_encode([
                        'id' => $course->id,
                        'title' => $course->title,
                    ])
                ]);

                redirect()->route('user.quiz',$transcript->id);
            }
        }

    }

    public function render()
    {
        $transcripts = $this->user->transcripts;
        return view('site.client.quizzes',['transcripts'=>$transcripts])->extends('site.layouts.client.client');
    }
}
