<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Enums\ReductionEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Exception;

class StoreCourse extends BaseComponent
{
    use WithFileUploads;
    public  $header , $slug , $title , $short_body , $long_body , $image  , $category ,  $quiz , $seo_keywords , $seo_description,
    $teacher , $level , $const_price , $status ,$reduction_type ,$reduction_value = 0 , $start_at , $expire_at , $episodes = [] , $tags = [];
    public $e_id , $e_file_storage , $e_video_storage , $e_allow_show_local_video , $e_title , $e_file , $e_link , $e_local_video , $e_api_bucket , $e_time , $e_view , $e_free , $modal_title , $e_key , $e_video_upload_method , $e_file_upload_method ;
    public $file , $video;
    public  $course , $sub_title , $storage;

    public $file_path , $video_path , $file_site , $video_site;

    public bool $episodeHasFile = false , $episodeHasVideo = false , $wasUploadedFile = false;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->tagRepository = app(TagRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->storage = $this->settingRepository->getRow('storage') ?? StorageEnum::PRIVATE;
        $this->disk = getDisk(storage:$this->storage);
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
            $this->start_at = $this->course->start_at;
            $this->expire_at = $this->course->expire_at;
            $this->episodes = $this->course->episodes->sortBy('view')->toArray();
            $this->tags = $this->course->tags->pluck('id','id')->toArray();
            $this->seo_keywords = $this->course->seo_keywords;
            $this->seo_description = $this->course->seo_description;
            $this->const_price = $this->course->const_price;
            $this->level = $this->course->level;
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
        $this->data['quiz'] = $this->quizRepository->getAll()->pluck('name','id');

    }

    public function render()
    {
        return view('admin.courses.store-course')->extends('admin.layouts.admin');
    }

    public function store()
    {
        $this->authorizing('edit_courses');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->course);
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->courseRepository->newCourseObject());
            $this->reset(['slug','sub_title','title','short_body','long_body','image','category','quiz','teacher',
                'status','level','reduction_type','const_price','reduction_value','start_at','expire_at','tags','episodes','seo_keywords','seo_description']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'title' => ['required','string','max:255'],
            'sub_title' => ['required','string','max:255'],
            'short_body' => ['required','string','max:5200'],
            'seo_keywords' => ['required','string','max:5200'],
            'seo_description' => ['required','string','max:5200'],
            'long_body' => ['required','string','max:35200'],
            'image' => ['required','string','max:255'],
            'category' => ['required','exists:categories,id'],
            'quiz' => ['nullable','exists:quizzes,id'],
            'teacher' => ['required','exists:users,id'],
            'const_price' => ['required','between:0,99999999999999.9999','numeric'],
            'status' => ['required','in:'.implode(',',array_keys(CourseEnum::getStatus()))],
            'reduction_type' => ['nullable','in:'.implode(',',array_keys(ReductionEnum::getType()))],
            'reduction_value' => ['required','numeric','between:0,9999999999999999999.99999999999'],
            'start_at' => ['nullable','date'],
            'expire_at' => ['nullable','date'],
            'episodes' => ['array','min:1'],
            'level' => ['required','in:'.implode(',',array_keys(CourseEnum::getLevels()))]
        ],[],[
            'title' => 'عنوان',
            'sub_title' => 'عنوان فرعی',
            'short_body' => 'توضیحات کوتاه',
            'seo_keywords' => 'کلمات سئو',
            'seo_description' => 'توضیحات سئو',
            'long_body' => 'توضیحات کامل',
            'image' => 'تصویر',
            'category' => 'دسته بندی',
            'quiz' => 'ازمون',
            'teacher' => 'مدرس',
            'status' => 'وضعیت',
            'const_price' => 'مبلغ ثابت',
            'reduction_type' => 'نوع تخفیف',
            'reduction_value' => 'مقدار تخفیف',
            'start_at' => 'شروع تخفیف',
            'expire_at' => 'پایان تخفیف',
            'episodes' => 'سرفصل ها',
            'level' => 'سطح دوره'
        ]);
        $model->title = $this->title;
        $model->sub_title = $this->sub_title;
        $model->short_body = $this->short_body;
        $model->long_body = $this->long_body;
        $model->image = $this->image;
        $model->category_id = $this->category;
        $model->quiz_id = $this->quiz;
        $model->teacher_id = $this->teacher;
        $model->status = $this->status;
        $model->const_price = $this->const_price;
        $model->reduction_type = $this->reduction_type;
        $model->reduction_value = $this->reduction_value;
        $model->level = $this->level;
        $model->start_at = $this->start_at ?? null;
        $model->expire_at = $this->expire_at ?? null;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $model = $this->courseRepository->save($model);

        foreach ($this->episodes as $item) {
            $episode =  $item['id'] <> 0 ? $this->episodeRepository->find($item['id']) : $this->episodeRepository->newEpisodeObject();
            $episode->title = $item['title'];
            $episode->file = $item['file'];
            $episode->link = $item['link'];
            $episode->local_video = $item['local_video'];
            $episode->api_bucket = $item['api_bucket'];
            $episode->view = $item['view'];
            $episode->time = $item['time'];
            $episode->free = $item['free'];
            $episode->file_storage = $item['file_storage'];
            $episode->video_storage = $item['video_storage'];
            $episode->allow_show_local_video = $item['allow_show_local_video'];
            $episode->course_id = $model->id;
            $this->episodeRepository->save($episode);
        }
        $this->episodes = $this->courseRepository->find($model->id)->episodes->sortBy('view')->toArray();
        $this->tags = array_filter($this->tags);
        if ($this->mode == self::CREATE_MODE)
            $this->courseRepository->attachTags($model,$this->tags);
        elseif ($this->mode == self::UPDATE_MODE)
            $this->courseRepository->syncTags($model,$this->tags);

        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function addEpisode($key)
    {
        if ($key == 'new') {
            $this->resetEpisodeInputs();
            $this->modal_title = 'سرفصل جدید';
            $this->e_key = -1;
            $this->e_time = '00:00:00';
            $this->e_free = 0;
            $this->e_view = 0;
            $this->e_file_storage = $this->storage;
            $this->e_video_storage = $this->storage;
            $this->e_allow_show_local_video = 0;
        } else {
            $this->e_key = $key;
            $episode = $this->episodes[$key];
            $this->modal_title = $episode['title'];
            $this->e_id = $episode['id'];
            $this->e_title = $episode['title'];
            $this->e_file = $episode['file'];
            $this->e_link = $episode['link'];
            $this->e_local_video = $episode['local_video'];
            $this->e_api_bucket = $episode['api_bucket'];
            $this->e_time = $episode['time'];
            $this->e_view = $episode['view'];
            $this->e_free = $episode['free'];
            $this->e_file_storage = in_array($episode['file_storage'] , array_keys($this->data['storage'])) ? $episode['file_storage'] : $this->storage;
            $this->e_video_storage = in_array($episode['video_storage'] , array_keys($this->data['storage'])) ? $episode['video_storage'] : $this->storage;
            $this->e_allow_show_local_video = $episode['allow_show_local_video'];
        }
        $this->emitShowModal('episode');
    }

    public function storeEpisode()
    {
        $this->validate([
            'e_title' => ['required','string','max:255'],
            'e_file' => ['nullable','string','max:10000'],
            'e_local_video' => ['nullable','max:255'],
            'e_api_bucket' => ['nullable','max:35000'],
            'e_time' => ['required','date_format:H:i:s','max:255'],
            'e_allow_show_local_video' => ['required','boolean'],
            'e_view' => ['required','integer'],
            'e_file_storage' => [Rule::requiredIf(fn() => !empty($this->e_file)) ,'in:'.implode(',',array_values(getAvailableStorages())).','.null],
            'e_video_storage' => [Rule::requiredIf(fn() => !empty($this->e_local_video)) ,'in:'.implode(',',array_values(getAvailableStorages())).','.null],
            'e_free' => ['boolean'],
        ],[],[
            'e_title' => ' عنوان سرفصل',
            'e_file' => 'فایل سرفصل',
            'e_link' => 'لینک سرفصل',
            'e_local_video' => 'ویدئو سرفصل',
            'video' => 'ویدئو سرفصل',
            'e_api_bucket' => 'api',
            'e_time' => 'زمان سرفصل',
            'e_file_storage' => 'فضای ذخیره سازی فایل',
            'e_video_storage' => 'فضای ذخیره سازی ویدئو',
            'e_view' => 'نمایش سرفصل',
            'e_allow_show_local_video' => 'اجازه برای نمایش ویدئو',
            'e_free' => 'رایگان',
            'file_path' => 'فایل سرفصل',
            'video_path' => 'ویدئو سرفصل',
        ]);
        if (sizeof($this->errorBag) == 0) {
            if ($this->e_key == -1) {
                $this->episodes[] = [
                    'id' => 0,
                    'title' => $this->e_title,
                    'file' => $this->e_file,
                    'link' => $this->e_link,
                    'local_video' => $this->e_local_video,
                    'api_bucket' => $this->e_api_bucket,
                    'time' => $this->e_time,
                    'view' => $this->e_view,
                    'free' => $this->e_free,
                    'file_storage' => $this->e_file_storage,
                    'video_storage' => $this->e_video_storage,
                    'allow_show_local_video' => $this->e_allow_show_local_video,
                ];
            } else {
                $this->episodes[$this->e_key] = [
                    'id' => $this->e_id,
                    'title' => $this->e_title,
                    'file' =>  $this->e_file,
                    'link' => $this->e_link,
                    'local_video' => $this->e_local_video,
                    'api_bucket' => $this->e_api_bucket,
                    'time' => $this->e_time,
                    'view' => $this->e_view,
                    'free' => $this->e_free,
                    'file_storage' => $this->e_file_storage,
                    'video_storage' => $this->e_video_storage,
                    'allow_show_local_video' => $this->e_allow_show_local_video,
                ];
            }
            $this->resetEpisodeInputs();
            $this->emitHideModal('episode');
        }
    }

    public function resetEpisodeInputs()
    {
        $this->reset([
            'e_id','e_file_storage','e_api_bucket','e_title','e_file','e_link','e_local_video','e_time','e_view','file_site','video_site',
            'e_free','file_path','video_path','wasUploadedFile','e_allow_show_local_video'  ,
            'e_video_storage','video','file'
        ]);
    }

    public function deleteEpisode($key)
    {
        $this->authorizing('edit_courses');
        $episode = $this->episodes[$key];
        if ($episode['id'] <> 0)
            $this->episodeRepository->destroy($episode['id']);

        unset($this->episodes[$key]);
        return $this->emitNotify('سرفصل با موفقیت حذف شد');
    }

    public function deleteItem()
    {
        $this->authorizing('cancel_courses');
        $this->courseRepository->delete($this->course);
        return redirect()->route('admin.course');
    }

}
