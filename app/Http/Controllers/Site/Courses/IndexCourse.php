<?php

namespace App\Http\Controllers\Site\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexCourse extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['q','category','type','orderBy','teacher','property'];
    public ?string $q = null , $category = null  , $orderBy = null , $type = null , $property = null , $teacher =null;
    public array $categories = [] , $types = [] , $orders = [] ;

    public function mount(
        CategoryRepositoryInterface $categoryRepository ,
        SettingRepositoryInterface $settingRepository,
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

        $this->categories = $categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]]);
        $this->types = ['free' => 'رایگان' , 'cash' => 'نقدی'];
        $this->data['types'] = CourseEnum::getTypes();
        $this->orders = [
            'latest' => 'جدید ترین' ,
            'oldest' => 'قدیمی ترین' ,
            'expensive' => 'گران ترین',
            'inexpensive' => 'ارزان ترین',
            CourseEnum::HOLDING => 'در حال برگذاری' ,
            CourseEnum::FINISHED => 'تکمیل شده' ,
        ];
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'دوره های اموزشی']
        ];
    }

    public function render(CourseRepositoryInterface $courseRepository)
    {
        $courses = $courseRepository->getAllSite($this->q ,$this->orderBy ,$this->type ,$this->category, $this->teacher,$this->property);
        return view('site.courses.index-course',['courses' => $courses])->extends('site.layouts.site.site');
    }
}
