<?php

namespace App\Http\Controllers\Admin\Samples;

use App\Enums\StorageEnum;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Enums\SampleEnum;
use App\Http\Controllers\BaseComponent;
use Illuminate\Support\Facades\Log;

class StoreSample extends BaseComponent
{
    public $slug , $title , $driver , $status , $type , $course , $file , $description , $header , $sample ,
    $seo_keywords , $seo_description;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->sampleRepository = app(SampleRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->driver = StorageEnum::PRIVATE;
        $this->authorizing('show_samples');
        $this->set_mode($action);
        $this->data['storage'] = getAvailableStorages();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        $this->data['status'] = SampleEnum::getStatus();
        $this->data['type'] = SampleEnum::getType();

        if ($this->mode == self::UPDATE_MODE) {
            $this->sample = $this->sampleRepository->findOrFail($id);
            $this->slug = $this->sample->slug;
            $this->title = $this->sample->title;
            $this->status = $this->sample->status;
            $this->type = $this->sample->type;
            $this->course = $this->sample->course_id;
            $this->file = $this->sample->file;
            $this->description = $this->sample->description;
            $this->seo_keywords = $this->sample->seo_keywords;
            $this->seo_description = $this->sample->seo_description;
            $this->header = $this->sample->title;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'نمونه سوال جدید';
        } else abort(404);
    }

    public function deleteItem()
    {
        $this->authorizing('delete_samples');
        $this->sampleRepository->destroy($this->sample->id);
        return redirect()->route('admin.sample');
    }

    public function store()
    {
        $this->authorizing('edit_samples');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->sample);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase( $this->sampleRepository->getNewObject());
            $this->reset(['slug','title','driver','status','type','course','file','description','seo_keywords','seo_description']);
        }
    }

    private function saveInDateBase($model)
    {
        $this->course = $this->emptyToNull($this->course);
        $fields = [
            'title' => ['required','string','max:250','unique:samples,title,'.($this->sample->id ?? 0)],
            'status' => ['required','in:'.implode(',',array_keys(SampleEnum::getStatus()))],
            'type' => ['required','in:'.implode(',',array_keys(SampleEnum::getType()))],
//            'driver' => ['required','in:'.implode(',',array_keys(getAvailableStorages()))],
            'course' => ['nullable','exists:courses,id'],
            'file' => ['required','string','max:32500'],
            'description' => ['nullable','string','max:154000'],
            'seo_keywords' => ['required','string','max:250'],
            'seo_description' => ['required','string','max:250'],
        ];
        $messages = [
            'title' => 'عنوان',
            'status' => 'وضعیت',
            'type' => 'نوع',
            'driver' => 'فضای ذخیره سازی',
            'course' => 'دوره',
            'file' => 'فایل',
            'description' => 'توضیحات',
            'seo_keywords' => 'کلمات کلیدی',
            'seo_description' => 'توضیحات سئو',
        ];
        $this->validate($fields,[],$messages);
        $model->title = $this->title;
        $model->status = $this->status;
        $model->type = $this->type;
        $model->driver = $this->driver;
        $model->course_id = $this->course;
        $model->file = $this->file;
        $model->description = $this->description;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $this->sampleRepository->save($model);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function download($file)
    {
        try {
            return getDisk($this->driver)->download($file);
        } catch (\Exception $e) {
            $this->emitNotify('خظا در هنگام دانلود فایل','warning');
            Log::error($e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.samples.store-sample')->extends('admin.layouts.admin');
    }
}
