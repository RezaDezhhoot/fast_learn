<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Enums\ReductionEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use Livewire\WithFileUploads;

class StoreCourse extends BaseComponent
{
    use WithFileUploads;
    public  $header , $slug , $title , $short_body , $long_body , $image  , $category ,  $quiz , $seo_keywords , $seo_description,
    $teacher , $level , $const_price , $status ,$reduction_type ,$reduction_value = 0 , $start_at , $expire_at  , $tags = [];
    public  $course , $sub_title , $storage , $type , $organizations = [] , $executives = [] , $standard_code , $has_organization_certificate = false;

    public $sellable = false;

    public $custom_hours;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->tagRepository = app(TagRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->organizationRepository = app(OrganizationRepositoryInterface::class);
        $this->executiveRepository = app(ExecutiveRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_courses');
        $this->set_mode($action);

        if ($this->mode == self::UPDATE_MODE) {
            $this->course = $this->courseRepository->find($id);
            $this->header = $this->course->title;
            $this->slug = $this->course->slug ;
            $this->title = $this->course->title;
            $this->sub_title = $this->course->sub_title;
            $this->short_body = $this->course->short_body;
            $this->long_body = $this->course->long_body;
            $this->image = $this->course->image;
            $this->category = $this->course->category_id;
            $this->quiz = $this->course->quiz_id;
            $this->teacher = $this->course->teacher_id;
            $this->status = $this->course->status;
            $this->reduction_type = $this->course->reduction_type;
            $this->reduction_value = $this->course->reduction_value;
            $this->start_at = $this->dateConverter($this->course->start_at);
            $this->expire_at = $this->dateConverter($this->course->expire_at);
            $this->tags = $this->course->tags->pluck('id','id')->toArray();
            $this->organizations = $this->course->organizations->pluck('id','id')->toArray();
            $this->executives = $this->course->executives->pluck('id','id')->toArray();
            $this->seo_keywords = $this->course->seo_keywords;
            $this->seo_description = $this->course->seo_description;
            $this->const_price = $this->course->const_price;
            $this->level = $this->course->level;
            $this->type = $this->course->type;
            $this->sellable = $this->course->sellable;
            $this->custom_hours = $this->course->custom_hours;
            $this->standard_code = $this->course->standard_code;
            $this->has_organization_certificate = $this->course->has_organization_certificate;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'دوره جدید';
        } else abort(404);
        $this->data['level'] = CourseEnum::getLevels();
        $this->data['category'] = $this->categoryRepository->getAll(CategoryEnum::COURSE)->pluck('title','id');
        $this->data['tags'] = $this->tagRepository->getAll()->pluck('name','id');
        $this->data['teacher'] = $this->teacherRepository->getAll()->map(function ($item){
            return [
                'id' => $item->id,
                'name' => "{$item->user->name} - {$item->user->phone}"
            ];
        })->pluck('name','id');

        $this->data['storage'] = array_flip(getAvailableStorages());

        $this->data['reduction'] = ReductionEnum::getType();
        $this->data['status'] = CourseEnum::getStatus();
        $this->data['type'] = CourseEnum::getTypes();
        $this->data['quiz'] = $this->quizRepository->getAll()->pluck('name','id');



    }

    public function render()
    {
        $this->data['organs'] = $this->organizationRepository->get(parent:true);
        $this->data['executives'] = $this->executiveRepository->get(parent:true);
        return view('admin.courses.store-course')->extends('admin.layouts.admin');
    }

    public function store()
    {
        $this->authorizing('edit_courses');
        if ($this->mode == self::UPDATE_MODE){
            $this->saveInDataBase($this->course);
            $this->start_at = $this->dateConverter($this->start_at) ;
            $this->expire_at = $this->dateConverter($this->expire_at) ;
        }
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->courseRepository->newCourseObject());
            $this->reset(['slug','sub_title','title','short_body','long_body','image','category','quiz','teacher','has_organization_certificate',
                'status','sellable','custom_hours','level','standard_code','type','reduction_type','const_price','reduction_value','start_at','expire_at','tags','seo_keywords','seo_description']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->quiz = $this->emptyToNull($this->quiz);
        $this->start_at = $this->dateConverter($this->start_at,'m') ;
        $this->expire_at = $this->dateConverter($this->expire_at,'m') ;
        $this->validate([
            'title' => ['required','string','max:255'],
            'standard_code' => ['required','string','max:50'],
            'sub_title' => ['required','string','max:255'],
            'short_body' => ['required','string','max:5200'],
            'seo_keywords' => ['required','string','max:5200'],
            'seo_description' => ['required','string','max:5200'],
            'long_body' => ['required','string','max:35200'],
            'image' => ['required','string','max:255'],
            'category' => ['required','exists:categories,id'],
            'quiz' => ['nullable','exists:quizzes,id'],
//            'teacher' => ['required','exists:users,id'],
            'const_price' => ['required','between:0,99999999999999.9999','numeric'],
            'status' => ['required','in:'.implode(',',array_keys(CourseEnum::getStatus()))],
            'reduction_type' => ['nullable','in:'.implode(',',array_keys(ReductionEnum::getType()))],
            'reduction_value' => ['required','numeric','between:0,9999999999999999999.99999999999'],
            'start_at' => ['nullable','date'],
            'expire_at' => ['nullable','date'],
            'level' => ['required','in:'.implode(',',array_keys(CourseEnum::getLevels()))],
            'type' => ['required','in:'.implode(',',array_keys(CourseEnum::getTypes()))],
            'has_organization_certificate' => ['required','boolean'],
            'custom_hours' => ['nullable','string','max:50'],
            'sellable' => ['boolean']
        ],[],[
            'title' => 'عنوان',
            'standard_code' => 'استاندارد اموزشی',
            'sub_title' => 'عنوان فرعی',
            'short_body' => 'توضیحات کوتاه',
            'seo_keywords' => 'کلمات سئو',
            'seo_description' => 'توضیحات سئو',
            'long_body' => 'توضیحات کامل',
            'image' => 'تصویر',
            'category' => 'دسته بندی',
            'quiz' => 'ازمون',
//            'teacher' => 'مدرس',
            'status' => 'وضعیت',
            'const_price' => 'مبلغ ثابت',
            'reduction_type' => 'نوع تخفیف',
            'reduction_value' => 'مقدار تخفیف',
            'start_at' => 'شروع تخفیف',
            'expire_at' => 'پایان تخفیف',
            'level' => 'سطح دوره',
            'type' => 'نوع دوره',
            'has_organization_certificate' => 'گواهینامه فنی و حرفه ای',
            'custom_hours' => 'زمان آموزشی',
            'sellable' => 'قابل خرید'
        ]);
        $model->title = $this->title;
        $model->sub_title = $this->sub_title;
        $model->short_body = $this->short_body;
        $model->long_body = $this->long_body;
        $model->image = $this->image;
        $model->category_id = $this->category;
        $model->quiz_id = $this->quiz;
        $model->teacher_id = null;
        $model->status = $this->status;
        $model->const_price = $this->const_price;
        $model->reduction_type = $this->reduction_type;
        $model->reduction_value = $this->reduction_value;
        $model->level = $this->level;
        $model->type = $this->type;
        $model->sellable = $this->sellable;
        $model->start_at = $this->start_at;
        $model->expire_at = $this->expire_at;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $model->standard_code = $this->standard_code;
        $model->custom_hours = $this->custom_hours;
        $model->has_organization_certificate = $this->has_organization_certificate;
        $model = $this->courseRepository->save($model);
        $this->tags = array_filter($this->tags);
        $this->organizations = array_filter($this->organizations);
        $this->executives = array_filter($this->executives);
        if ($this->mode == self::CREATE_MODE) {
            $this->courseRepository->attachTags($model,$this->tags);
            $this->courseRepository->attachOrgans($model,$this->organizations);
            $this->courseRepository->attachExecutives($model,$this->executives);
        }
        elseif ($this->mode == self::UPDATE_MODE) {
            $this->courseRepository->syncTags($model,$this->tags);
            $this->courseRepository->syncOrgans($model,$this->organizations);
            $this->courseRepository->syncExecutives($model,$this->executives);
        }

        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteItem()
    {
        $this->authorizing('cancel_courses');
        $this->courseRepository->delete($this->course);
        return redirect()->route('admin.course');
    }

}
