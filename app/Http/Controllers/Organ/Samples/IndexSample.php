<?php

namespace App\Http\Controllers\Organ\Samples;

use App\Enums\SampleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IndexSample extends BaseComponent
{
    use WithPagination;

    public $status , $course ,  $placeholder = 'عنوان نمونه سوال';
    protected $queryString = ['status','course'];


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = SampleEnum::getStatus();
        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
    }

    public function render()
    {
        $samples = $this->sampleRepository->getAllOrgans($this->search,$this->status,$this->course,$this->per_page);
        return view('organ.samples.index-sample',get_defined_vars())->extends('organ.layouts.organ');
    }
}
