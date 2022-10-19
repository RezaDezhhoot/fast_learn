<?php

namespace App\Http\Controllers\Teacher\Courses;

use App\Enums\CourseEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class StoreCourse extends BaseComponent
{
    use WithFileUploads;
    public $title , $descriptions , $level  ,$files = [] , $header;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
        $this->disk = getDisk(StorageEnum::PRIVATE);
    }

    public function mount()
    {
        $this->mode = self::CREATE_MODE;
        $this->data['level'] = CourseEnum::getLevels();
        $this->header = 'ثبت درخواست برای شروع دوره جدید';
    }

    public function store()
    {
        $this->saveInDataBase($this->newCoursesRepository->getNewObject());
        $this->reset(['title','descriptions','level','files']);
    }

    private function saveInDataBase($mode)
    {
        $this->validate([
            'title' => ['required','string','max:170'],
            'descriptions' => ['nullable','string','max:80000'],
            'level' => ['required','in:'.implode(',',array_keys(CourseEnum::getLevels()))],
            'files' => [Rule::requiredIf(function(){
                return sizeof($this->files) > 0;
            }), 'array', 'max:5'],
            'files.*' => ['required', 'mimes:jpg,jpeg,png,pdf,zip,rar', 'max:2048'],
        ],[],[
            'files' => 'فایل ها',
            'title' => 'عنوان',
            'descriptions' => 'توضیحات',
            'level' => 'سطح دوره',
        ]);
        $mode->title = $this->title;
        $mode->descriptions = $this->descriptions;
        $mode->level = $this->level;
        $mode->user_id = Auth::id();
        $mode->status = CourseEnum::NEW_COURSE_PENDING;
        $mode->files = $this->uploadFiles();
        $model = $this->newCoursesRepository->save($mode);
        $this->emitNotify('اطلاعات با موفیت ذخیره شد');
    }

    private function uploadFiles()
    {
        $file = [];
        foreach ($this->files as $value) {
            if (isset($value) && !empty($value))
                $file[] = $this->disk->put('new_courses/'.$this->title, $value);
        }

        return implode(',',$file);
    }

    public function addFile()
    {
        if (sizeof($this->files) < 5) {
            $this->files[] = null;
        }
    }

    public function deleteFile($key)
    {
        unset($this->files[$key]);
    }

    public function render()
    {
        return view('teacher.courses.store-course')->extends('teacher.layouts.teacher');
    }
}
