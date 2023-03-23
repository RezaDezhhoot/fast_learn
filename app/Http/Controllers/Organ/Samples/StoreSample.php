<?php

namespace App\Http\Controllers\Organ\Samples;

use App\Enums\LastActivitiesEnum;
use App\Enums\SampleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StoreSample extends BaseComponent
{
    public  $title , $driver  , $type , $course , $file , $description , $header , $sample;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_samples');
        $this->set_mode($action);
        $this->data['storage'] = getAvailableStorages();
        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
        $this->data['type'] = SampleEnum::getType();

        if ($this->mode == self::UPDATE_MODE) {
            $this->sample = $this->sampleRepository->findOrFailOrgan($id);
            $this->title = $this->sample->title;
            $this->driver = $this->sample->driver;
            $this->type = $this->sample->type;
            $this->course = $this->sample->course_id;
            $this->file = $this->sample->file;
            $this->description = $this->sample->description;
            $this->header = $this->sample->title;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'نمونه سوال جدید';
        } else abort(404);
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->sample);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase( $this->sampleRepository->getNewObject());
            $this->reset(['title','driver','type','course','file','description']);
        }
    }

    private function saveInDateBase($model)
    {
        $fields = [
            'title' => ['required','string','max:250'],
            'type' => ['required','in:'.implode(',',array_keys(SampleEnum::getType()))],
            'driver' => ['required','in:'.implode(',',array_keys(getAvailableStorages()))],
            'course' => ['nullable','in:'.implode(',',array_keys($this->data['course']))],
            'file' => ['required','string','max:32500'],
            'description' => ['nullable','string','max:154000'],
        ];
        $messages = [
            'title' => 'عنوان',
            'type' => 'نوع',
            'driver' => 'فضای ذخیره سازی',
            'course' => 'دوره',
            'file' => 'فایل',
            'description' => 'توضیحات',
        ];
        $this->validate($fields,[],$messages);
        $model->title = $this->title;
        $model->type = $this->type;
        $model->driver = $this->driver;
        $model->course_id = $this->course;
        $model->file = $this->file;
        if ($this->mode == self::CREATE_MODE) {
            $model->status = SampleEnum::DEMO;
        }
        $model->description = $this->description;
        $model = $this->sampleRepository->save($model);
        if ($model->wasChanged() && $this->mode != self::CREATE_MODE) {
            $model->status = SampleEnum::DEMO;
            $this->sampleRepository->save($model);
        }

        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('organ.samples.store-sample')->extends('teacher.layouts.teacher');
    }
}
