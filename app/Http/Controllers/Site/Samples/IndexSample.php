<?php

namespace App\Http\Controllers\Site\Samples;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexSample extends BaseComponent
{
    use WithPagination;

    public array $categories = [];
    public ?string $q = null , $category = null;
    protected $queryString = ['q','category'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
    }

    public function search()
    {
        //
    }

    public function mount()
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').' نمونه سوالات ');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' نمونه سوالات ');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' نمونه سوالات ');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').' نمونه سوالات ');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->categories = $this->categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]]);
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'نمونه سوالات']
        ];
    }

    public function render()
    {
        $samples = $this->sampleRepository->getAllSite($this->q,$this->category,30);
        return view('site.samples.index-sample',['samples'=> $samples])->extends('site.layouts.site.site');
    }
}
