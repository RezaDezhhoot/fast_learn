<?php

namespace App\Http\Controllers\Organ\Courses;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class EditContent extends BaseComponent
{
    public $course;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount($id)
    {
        $this->course = $this->courseRepository->findOrgan($id);
        $this->course->load(['chapters.episodes']);
    }

    public function store()
    {
        $this->emit('storeChapters',['course' => $this->course,'transcript' => true]);
    }

    public function render()
    {
        return view('organ.courses.edit-content')->extends('organ.layouts.organ');
    }
}
