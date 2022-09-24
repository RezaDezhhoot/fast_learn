<?php

namespace App\Http\Controllers\Site\Samples;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class SingleSample extends BaseComponent
{
    public $sample;
    public  $related_samples;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    public function mount($slug)
    {
        $this->sample = $this->sampleRepository->findBySlug($slug);
        SEOMeta::setTitle($this->sample->title);
        SEOMeta::setDescription($this->sample->seo_description);
        SEOMeta::addKeyword($this->sample->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->sample->title);
        OpenGraph::setDescription($this->sample->seo_description);
        TwitterCard::setTitle($this->sample->title);
        TwitterCard::setDescription($this->sample->seo_description);
        JsonLd::setTitle($this->sample->title);
        JsonLd::setDescription($this->sample->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'samples' => ['link' => route('samples') , 'label' => 'نمونه سوالات'],
            'sample' => ['link' => '' , 'label' => $this->sample->title],
        ];

        $this->related_samples = $this->sampleRepository->getRelatedSamples($this->sample);
    }

    public function render()
    {
        return view('site.samples.single-sample')->extends('site.layouts.site.site');
    }

    public function download()
    {
       return $this->sampleRepository->download($this->sample);
    }
}
