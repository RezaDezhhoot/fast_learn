<?php

namespace App\Http\Controllers\Site\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexCourse extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['q','category','type','orderBy','teacher','property','organs'];
    public ?string $q = null , $category = null  , $orderBy = null , $type = null , $property = null , $teacher =null;
    public $categories = [] , $types = [] , $orders = [] , $organs;

    public function mount(
        CategoryRepositoryInterface $categoryRepository ,
        SettingRepositoryInterface $settingRepository,
        OrganizationRepositoryInterface $organizationRepository ,
        ExecutiveRepositoryInterface $executiveRepository
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
        $categories = $categoryRepository->getAll(CategoryEnum::COURSE,[['parent_id',null]]);
        foreach ($categories as $item){
            $item->sub_categories = array_value_recursive('slug',$item->childrenRecursive->toArray());
            $item->sub_categories_title = array_value_recursive('title',$item->childrenRecursive->toArray());
        }

        $this->categories = $categories->toArray();
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

        $this->data['organs'] = $organizationRepository->get(parent:true)->toArray();
    }

    public function render(CourseRepositoryInterface $courseRepository)
    {
        $courses = $courseRepository->getAllSite(
            $this->q ,$this->orderBy ,$this->type ,$this->category, $this->teacher,$this->property ,
            $this->organs 
        );
        return view('site.courses.index-course',['courses' => $courses])->extends('site.layouts.site.site');
    }
}
