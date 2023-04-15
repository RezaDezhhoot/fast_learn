<?php

namespace App\Http\Controllers\Site\Client\Ratings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class StoreRating extends BaseComponent
{
    public $course;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount($id)
    {
        $this->course =  $courses = collect(auth()->user()->orderDetails)->where('course_id',$id)->first()->course;
        abort_if(
            ! $this->course ||
            ! $this->course->form ||
            collect(auth()->user()->ratings)->where('form_id', $this->course->form_id)->first()
            ,404);
    }

    public function render()
    {
        return view('site.client.ratings.store-rating')
            ->extends('site.layouts.client.client');
    }
}
