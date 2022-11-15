<?php

namespace App\Http\Controllers\Site\Teachers;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class IndexTeacher extends BaseComponent
{

    public function mount(
        SettingRepositoryInterface $settingRepository
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' مدرسین ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' مدرسین ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' مدرسین ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' مدرسین ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'teachers' => ['link' => '' , 'label' => 'مدرسین']
        ];
    }

    public function render(TeacherRepositoryInterface $teacherRepository)
    {
        $teachers = $teacherRepository->getAllAdmin(null,10,true);
        return view('site.teachers.index-teacher',['teachers'=>$teachers])->extends('site.layouts.site.site');
    }
}
