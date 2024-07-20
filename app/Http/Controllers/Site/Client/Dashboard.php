<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\CourseEnum;
use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Dashboard extends BaseComponent
{
    public mixed $user , $notifications;
    public int $courses = 0 , $myCourses = 0 , $myQuizzes = 0;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount(
        SettingRepositoryInterface $settingRepository,
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
        $this->courses = $this->courseRepository->getAll()->count();
        $this->myQuizzes = collect($this->user->transcripts)->where('result',QuizEnum::PENDING)->count();
        $this->notifications = $this->user->alerts()->take(10)->get();
    }

    public function render()
    {
        $gCourses = $this->courseRepository->getAllSite(
            level_type: CourseEnum::LEVEL_TYPE_GENERAL, paginate: false
        );
        $pCourses = $this->courseRepository->getAllSite(
            level_type: CourseEnum::LEVEL_TYPE_PROFESSIONAL, paginate: false
        );
        return view('site.client.dashboard' , get_defined_vars())->extends('site.layouts.client.client');
    }
}
