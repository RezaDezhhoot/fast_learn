<?php

namespace App\Http\Controllers\Site\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Fag extends BaseComponent
{
    public $fag;
    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'- سوالات متداول ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' سوالات متداول -');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' سوالات متداول -');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' سوالات متداول -');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->fag = $settingRepository->getFagList();
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'فکور'],
            'fag' => ['link' => '' , 'label' => 'سوالات متداول']
        ];
    }
    public function render()
    {
        return view('site.settings.fag')->extends('site.layouts.site.site');
    }
}
