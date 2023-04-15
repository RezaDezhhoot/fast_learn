<?php

namespace App\Http\Controllers\Site\Organs;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Organ extends BaseComponent
{
    public $organ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organRepository = app(OrganRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($slug)
    {
        $this->organ = $this->organRepository->findBYSlug($slug);

        SEOMeta::setTitle($this->settingRepository->getRow('title').' | '.$this->organ->title);
        SEOMeta::setDescription($this->organ->seo_description);
        SEOMeta::addKeyword($this->organ->seo_key_words);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' | '.$this->organ->title);
        OpenGraph::setDescription($this->organ->seo_description);
        TwitterCard::setTitle($this->settingRepository->getRow('title').' | '.$this->organ->title);
        TwitterCard::setDescription($this->organ->seo_key_words);
        JsonLd::setTitle($this->settingRepository->getRow('title').' | '.$this->organ->title);
        JsonLd::setDescription($this->organ->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
    }

    public function render()
    {
        return view('site.organs.organ')->extends('site.layouts.site.site');
    }
}
