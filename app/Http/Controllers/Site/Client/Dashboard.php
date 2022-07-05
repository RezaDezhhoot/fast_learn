<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\QuizEnum;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class Dashboard extends Component
{
    public mixed $user , $notifications;
    public int $courses = 0 , $myCourses = 0 , $myQuizzes = 0;
    public function mount(
        SettingRepositoryInterface $settingRepository,
        CourseRepositoryInterface $courseRepository ,
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.' داشبورد پنل کاربری');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.' داشبورد پنل کاربری');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.' داشبورد پنل کاربری');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.' داشبورد پنل کاربری');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->user = auth()->user();
        $this->myCourses = $this->user->orderDetails->count();
        $this->courses = $courseRepository->getAll()->count();
        $this->myQuizzes = collect($this->user->transcripts)->where('result',QuizEnum::PENDING)->count();
        $this->notifications = $this->user->alerts;
    }

    public function render()
    {
        return view('site.client.dashboard')->extends('site.layouts.client.client');
    }
}
