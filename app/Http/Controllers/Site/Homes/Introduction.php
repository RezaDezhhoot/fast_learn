<?php

namespace App\Http\Controllers\Site\Homes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class Introduction extends BaseComponent
{
    public $logo , $title ;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->logo = asset($this->settingRepository->getRow('logo'));
        $this->title = $this->settingRepository->getRow('title');

        SEOMeta::setTitle($this->title);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->title);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title'));
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->title);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage($this->logo);
    }

    public function render()
    {
        return view('site.homes.introduction')->extends('site.layouts.site.site');
    }
}
