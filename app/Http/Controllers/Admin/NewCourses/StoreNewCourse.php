<?php

namespace App\Http\Controllers\Admin\NewCourses;

use App\Enums\CourseEnum;
use App\Enums\StorageEnum;
use App\Events\NewCourseEvent;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Traits\ChatPanel;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class StoreNewCourse extends BaseComponent
{
    use WithFileUploads , ChatPanel;
    public $course , $status , $result , $header , $component = 'admin';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('show_new_courses');
        self::set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->course = $this->newCoursesRepository->findOrFail($id);
            $this->header = $this->course->title;
            $this->status = $this->course->status;
            $this->result = $this->course->result;
        } else abort(404);

        $this->data['status'] = CourseEnum::getNewCourseStatus();
    }

    public function deleteItem()
    {
        $this->authorizing('delete_new_courses');
        $this->newCoursesRepository->destroy($this->course->id);
        redirect()->route('admin.newCourse');
    }

    public function store()
    {
        $this->authorizing('edit_new_courses');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->course);
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'status' => ['required','string','in:'.implode(',',array_keys(CourseEnum::getNewCourseStatus()))],
            'result' => ['nullable','string','max:250000']
        ],[],[
            'status' => 'وضعیت',
            'result' => 'پاسخ کوتاه'
        ]);
        $model->status = $this->status;
        $model->result = $this->result;
        $model = $this->newCoursesRepository->save($model);
        $this->emitNotify('اطلاعات با موفقیت ذخیره شد');

        NewCourseEvent::dispatch($model);
    }



    public function render()
    {
        return view('admin.new-courses.store-new-course')->extends('admin.layouts.admin');
    }
}
