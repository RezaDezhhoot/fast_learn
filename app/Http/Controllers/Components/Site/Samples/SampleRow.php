<?php

namespace App\Http\Controllers\Components\Site\Samples;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SampleRepositoryInterface;

class SampleRow extends BaseComponent
{

    public $sample , $show_course_name;

    public function __construct()
    {
        $this->sampleRepository = app(SampleRepositoryInterface::class);
    }

    public function mount($sample , $show_course_name = false)
    {
        $this->sample = $sample;
        $this->show_course_name = $show_course_name;
    }

    public function render()
    {
        return view('components.site.samples.sample-row',['sample'=>$this->sample,'show_course_name'=>$this->show_course_name]);
    }

    public function download()
    {
        return $this->sampleRepository->download($this->sample->id);
    }
}
