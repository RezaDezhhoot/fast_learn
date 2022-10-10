<?php

namespace App\Http\Controllers\Site\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class TeacherRequest extends BaseComponent
{
    public $descriptions , $files , $url;
    
    public function __construct()
    {
        $this->teacherRequestRepository = app(TeacherRequestRepositoryInterface::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'- مدرس شوید');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->fag = $settingRepository->getFagList();
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'fag' => ['link' => '' , 'label' => 'مدرس شوید']
        ];
    }

    public function store()
    {
        $this->validate([
            'descriptions' => ['required','string','max:125000'],
            'files' => ['nullable','array','max:5'],
            'files.*' => ['required','file','max:1028','mimes:png,jpeg,pdf,zip,rar'],
            'url' => ['nullable','url','max:250']
        ],[],[
            'descriptions' => 'توضیحات',
            'files' => 'فایل های سرفصل و رزومه',
            'files.*' => 'فایل های سرفصل و رزومه',
            'url' => 'ادرس رزومه'
        ]);

        

    }

    public function render()
    {
        return view('site.settings.teacher-request')->extends('site.layouts.site.site');
    }
}
