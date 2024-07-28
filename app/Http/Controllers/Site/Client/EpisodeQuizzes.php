<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Models\Course;
use App\Models\EpisodeQuiz;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserEpisodeQuizResult;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EpisodeQuizzes extends BaseComponent
{
    public $course;
    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' گزارش پیشرفت ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' گزارش پیشرفت');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' گزارش پیشرفت ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' گزارش پیشرفت ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

        $this->data['course'] = Course::query()->latest()->whereHas('details' , function ($q) {
            $q->whereHas('order' , function ($q) {
                $q->where('user_id' ,\auth()->id());
            });
        })->get()->pluck('title','id');
    }

    public function render()
    {
        $items = EpisodeQuiz::query()
            ->withCount(['results' => function ($q) {
                $q->where('user_id',\auth()->id());
            }])
            ->with(['questions' => function ($q) {
                $q->with(['answers'])
                    ->withCount(['answers as correct_answers' => function ($q) {
                        $q->where('status', true)->where('user_id', auth()->id());
                    }])
                    ->withCount(['answers as incorrect_answers' => function ($q) {
                        $q->where('status', false)->where('user_id', auth()->id());
                    }])
                    ->whereHas('answers' , function ($q) {
                        $q->where('user_id', auth()->id());
                    })
                    ->when($this->course , function ($q) {
                        $q->where(function ($q){
                            $q->whereHas('episodeQuizzes' , function ($q) {
                                $q->whereHas('episode' , function ($q){
                                    $q->whereHas('chapter' , function ($q) {
                                        $q->whereHas('course' , function ($q) {
                                            $q->where('id' , $this->course);
                                        });
                                    });
                                });
                            })->orWherehas('quizzes' , function ($q) {
                                $q->whereHas('courses' , function ($q){
                                    $q->where('id' , $this->course);
                                });
                            });
                        });
                    })
                ;
            }])->get()->map(function ($item){
                $item['correct_answers'] = collect($item['questions'])->sum('correct_answers');
                $item['incorrect_answers'] = collect($item['questions'])->sum('incorrect_answers');
                return $item;
            })
        ;
        return view('site.client.episode-quizzes' , get_defined_vars())->extends('site.layouts.client.client');
    }
}
