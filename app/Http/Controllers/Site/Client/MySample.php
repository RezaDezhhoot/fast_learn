<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class MySample extends BaseComponent
{
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.'  نمونه سوالات من');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.'  نمونه سوالات من');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.'  نمونه سوالات من');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.'  نمونه سوالات من');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
    }

    public function render()
    {
        $samples = [];
        $courses = auth()->user()->courses;
        foreach ($courses as $value) {
            foreach ($value->samples as $item) {
                $samples[] = $item;
            }
        }
        return view('site.client.my-sample',['samples'=>array_unique($samples)])->extends('site.layouts.client.client');
    }
}
