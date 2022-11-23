<?php

namespace App\Http\Controllers\Admin\Samples;

use App\Enums\SampleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\WithPagination;


class IndexSample extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['course'];

    public ?string $course = null , $status = null , $placeholder = 'عنوان نمونه سوال';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
    }
    
    public function mount()
    {
        $this->data['status'] = SampleEnum::getStatus();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function render()
    {
        $this->authorizing('show_samples');
        $samples = $this->sampleRepository->getAllAdmin($this->search , $this->status , $this->course , $this->per_page);
        return view('admin.samples.index-sample',['samples'=>$samples])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_samples');
        $this->sampleRepository->destroy($id);
    }
}
