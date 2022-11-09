<?php

namespace App\Http\Controllers\Teacher\Samples;

use App\Enums\SampleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class IndexSamples extends BaseComponent
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
        $this->data['course'] = Auth::user()->teacher->courses->pluck('title','id');
    }

    public function render()
    {
        $samples = $this->sampleRepository->getAllTeacher($this->search,$this->status,$this->course,$this->per_page);
        return view('teacher.samples.index-samples',['samples'=>$samples])->extends('teacher.layouts.teacher');
    }
}
