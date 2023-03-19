<?php

namespace App\Http\Controllers\Teacher\RollCalls;

use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\WithPagination;

class IndexRollCall extends BaseComponent
{
    use WithPagination;

    public ?string $placeholder = 'عنوان دوره';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {

    }

    public function render()
    {
        $courses = $this->courseRepository->getAllTeacher($this->search,false ,false,$this->per_page);
        return view('teacher.roll-calls.index-roll-call',['courses'=>$courses])
            ->extends('teacher.layouts.teacher');
    }
}
