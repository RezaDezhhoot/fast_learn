<?php

namespace App\Http\Controllers\Site\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Contact extends BaseComponent
{
    public $tel , $address , $email , $google , $contact;
    public $instagram , $twitter , $youtube , $telegram;

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->address = $settingRepository->getRow('address');
        $this->email = $settingRepository->getRow('email');
        $this->tel = $settingRepository->getRow('tel');
        $this->contact = $settingRepository->getRow('contactText');
        $this->google = $settingRepository->getRow('googleMap');
        $this->instagram = $settingRepository->getRow('instagram');
        $this->twitter = $settingRepository->getRow('twitter');
        $this->youtube = $settingRepository->getRow('youtube');
        $this->telegram = $settingRepository->getRow('telegram');
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'contact' => ['link' => '' , 'label' => 'ارتباط با ما']
        ];
    }
    public function render()
    {
        return view('site.settings.contact')->extends('site.layouts.site.site');
    }
}
