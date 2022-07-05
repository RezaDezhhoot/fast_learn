<?php

namespace App\Http\Controllers\Site\Homes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Home extends BaseComponent
{
    public $content = [] , $starter = [];
    public function mount
    (
        SettingRepositoryInterface $settingRepository ,
        UserRepositoryInterface $userRepository ,
        CertificateRepositoryInterface $certificateRepository ,
        TeacherRepositoryInterface $teacherRepository ,
        QuizRepositoryInterface $quizRepository
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title'));
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title'));
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title'));
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title'));
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $content = $settingRepository->getRow('homeContent',[]);
        $send = [];
        $i = 0;
        foreach ($content as  $value)
        {
            if ($value['category'] <> 'banners')
            {
                $model = $settingRepository::models()[$value['category']];
                $send[$i] = $value;
                $send[$i]['content'] = $model::findMany($value['contentCase']);

            } else
                $send[$i] = $value;
            $i++;
        }
        $this->content = array_values(collect($send)->sortBy('view')->toArray());
        $this->starter = [
            'users' => $userRepository->count(),
            'teachers' => $teacherRepository->count(),
            'quizzes' => $quizRepository->count(),
            'certificates' => $certificateRepository->count()
        ];
    }

    public function render()
    {
        return view('site.homes.home')->extends('site.layouts.site.site');
    }
}
