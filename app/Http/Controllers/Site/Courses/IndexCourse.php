<?php

namespace App\Http\Controllers\Site\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexCourse extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['q','category','type','orderBy','teacher','property'];
    public ?string $q = null , $category = null  , $orderBy = null , $province = null , $city = null , $type = null , $property = null , $teacher =null;
    public array $categories = [] , $types = [] , $orders = [] ;

    public function __construct()
    {
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
    }

    public function mount(
        CategoryRepositoryInterface $categoryRepository ,
    )
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').' دوره های اموزشی ');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' دوره های اموزشی ');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' دوره های اموزشی ');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').' دوره های اموزشی ');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));

        $this->categories = $categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]]);
        $this->types = ['free' => 'دوره های اموزشی رایگان' , 'cash' => 'دوره های اموزشی نقدی'];
        $this->data['types'] = CourseEnum::getTypes();
        $this->orders = [
            'latest' => 'جدید ترین دوره های اموزشی' ,
            'oldest' => 'قدیمی ترین دوره های اموزشی' ,
            'expensive' => 'گران ترین دوره های اموزشی',
            'inexpensive' => 'ارزان ترین دوره های اموزشی',
            CourseEnum::HOLDING => 'دوره های اموزشی در حال برگذاری' ,
            CourseEnum::FINISHED => 'دوره های اموزشی تکمیل شده' ,
        ];
        $this->data['province'] = $this->settingRepository::getProvince();
        $this->data['city'] = [];
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'دوره های اموزشی']
        ];
        $this->data['teachers'] = $this->teacherRepository->getAll()->pluck('user_name','short_code')->toArray();
    }

    public function updatedProvince()
    {
        if (!empty($this->province))
            $this->data['city'] = $this->settingRepository::getCities()[$this->province];
    }

    public function render(CourseRepositoryInterface $courseRepository)
    {
        $courses = $courseRepository->getAllSite(
            $this->q ,$this->orderBy ,$this->type ,
            $this->category, $this->teacher,$this->property , $this->province , $this->city
        );
        return view('site.courses.index-course',['courses' => $courses])->extends('site.layouts.site.site');
    }
}
