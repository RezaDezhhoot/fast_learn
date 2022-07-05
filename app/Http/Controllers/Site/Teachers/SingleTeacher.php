<?php

namespace App\Http\Controllers\Site\Teachers;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class SingleTeacher extends Component
{
    public $teacher , $page_address = [];
    public function mount(
        SettingRepositoryInterface $settingRepository,
        TeacherRepositoryInterface $teacherRepository,
        $id
    )
    {
        $this->teacher = $teacherRepository->find($id);
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.$this->teacher->user->name);
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.$this->teacher->user->name);
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.$this->teacher->user->name);
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.$this->teacher->user->name);
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'teachers' => ['link' =>  route('teachers')  , 'label' => 'مدرسین'],
            'teacher' => ['link' =>'' , 'label' => $this->teacher->user->name]
        ];
    }

    public function render()
    {
        return view('site.teachers.single-teacher')->extends('site.layouts.site.site');
    }
}
