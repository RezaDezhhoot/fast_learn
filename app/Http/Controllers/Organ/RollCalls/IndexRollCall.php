<?php

namespace App\Http\Controllers\Organ\RollCalls;

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

    public function render()
    {
        $courses = $this->courseRepository->getAllOrgan($this->search,false ,false,$this->per_page);
        return view('organ.roll-calls.index-roll-call',get_defined_vars())
            ->extends('organ.layouts.organ');
    }
}
