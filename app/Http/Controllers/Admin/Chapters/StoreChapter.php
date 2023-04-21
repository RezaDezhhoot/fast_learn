<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Validation\Rule;

class StoreChapter extends BaseComponent
{
    public $header , $chapter , $slug , $title , $status , $description ,$course , $view;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_chapters');
        $this->set_mode($action);
        $this->data['status'] = ChapterEnum::getStatus();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        if ($this->mode == self::UPDATE_MODE) {
            $this->chapter = $this->chapterRepository->findOrFail($id);
            $this->title = $this->chapter->title;
            $this->slug = $this->chapter->slug;
            $this->status = $this->chapter->status;
            $this->description = $this->chapter->description;
            $this->course = $this->chapter->course_id;
            $this->view = $this->chapter->view;
            $this->header = " {$this->chapter->course->title} - {$this->chapter->title}";
        } elseif ($this->mode = self::CREATE_MODE) {
            $this->header = 'تعریف فصل جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_chapters');
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->chapter);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->chapterRepository->newModel());
            $this->resetInput();
        }
    }

    public function resetInput()
    {
        $this->reset(['title','status','description','course']);
    }

    private function saveInDataBase($chapter)
    {
        $this->validate([
            'title' => ['required','string','max:250'],
            'status' => ['required',Rule::in(array_keys(ChapterEnum::getStatus()))],
            'description' => ['nullable','string','max:400'],
            'course' => ['required','exists:courses,id'],
            'view' => ['required','integer'],
        ],[],[
            'title' => 'عنوان',
            'status' => 'وضعیت',
            'description' => 'توضیحات',
            'course' => 'دوره آموزشی',
            'view' => 'شماره نمایش ',
        ]);
        $chapter->title = $this->title;
        $chapter->status = $this->status;
        $chapter->description = $this->description;
        $chapter->course_id = $this->course;
        $chapter->view =$this->view;
        $this->chapterRepository->save($chapter);
        $this->emitNotify('اظلاعات با موفقیت ذخیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_chapters');
        $this->chapter->delete();
        return redirect()->route('admin.chapter');
    }

    public function render()
    {
        return view('admin.chapters.store-chapter')
            ->extends('admin.layouts.admin');
    }
}
