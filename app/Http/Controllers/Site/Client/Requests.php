<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Requests extends BaseComponent
{
    public $result;
    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.' درخواست های همکاری ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.' درخواست های همکاری ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.'   درخواست های همکاری ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.'   درخواست های همکاری  ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
    }

    public function render()
    {
        $requests = auth()->user()->applies;
        return view('site.client.requests',['requests'=>$requests])->extends('site.layouts.client.client');
    }

    public function show_details($key)
    {
        $this->result = auth()->user()->applies[$key]->result;
    }
}
