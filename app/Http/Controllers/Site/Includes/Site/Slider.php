<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Slider extends BaseComponent
{
    public $q;

    protected $queryString = ['q'];

    public  $slider , $sliderImage , $sliderLink , $count;

    public function mount
    (
        CourseRepositoryInterface $courseRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->slider = $settingRepository->getRow('slider');
        $this->sliderImage = $settingRepository->getRow('sliderImage');
        $this->sliderLink = $settingRepository->getRow('sliderLink');
        $this->count = $courseRepository->count();
    }

    public function render()
    {
        return view('site.includes.site.slider');
    }

    public function search()
    {
        redirect()->route('courses',['q'=>$this->q]);
    }
}
