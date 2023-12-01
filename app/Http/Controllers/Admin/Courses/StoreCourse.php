<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\CategoryEnum;
use App\Enums\ChapterEnum;
use App\Enums\CourseEnum;
use App\Enums\EpisodeEnum;
use App\Enums\ReductionEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Chapter;
use App\Models\ChapterTranscript;
use App\Models\Course;
use App\Models\Episode;
use App\Models\EpisodeTranscript;
use App\Models\Poll;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\IncomingMethodRepositoryInterface;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class StoreCourse extends BaseComponent
{
    use WithFileUploads;
    public  $header , $slug , $title , $short_body , $long_body , $image  , $category ,  $quiz , $seo_keywords , $seo_description,
        $teacher , $level , $const_price , $status ,$reduction_type ,$reduction_value = 0 , $start_at , $expire_at  , $tags = [];

    public  $course , $sub_title , $storage , $type , $incomingMethod , $province , $city;

    public  $time_lapse , $organ_id , $poll_id  , $time_line;

    public $tab = 'course';

    protected $queryString = ['tab'];


    public $chapters = [];


    public $item_slug , $item_title , $item_status , $description , $item_view;

    public $chapter_key;

    public $epiosde_key;

    public  $link , $time = '00:00:00' , $free = 0 , $api_bucket , $file_storage , $file ,$local_video ,
        $video_storage , $allow_show_local_video = 0   , $can_homework = false , $homework_storage ,
        $show_api_video = false , $downloadable_local_video = false ;


    public $has_file = false , $has_video = false , $has_homework = false , $has_link = false , $has_bucket = false;

    public $new_file , $new_local_video;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->tagRepository = app(TagRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->quizRepository = app(QuizRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->incomingMethodRepository = app(IncomingMethodRepositoryInterface::class);
        $this->organRepository = app(OrganRepositoryInterface::class);
        $this->formReposirtory = app(FormRepositoryInterface::class);
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
            $this->seo_keywords = $this->course->seo_keywords;
            $this->seo_description = $this->course->seo_description;
            $this->const_price = $this->course->const_price;
            $this->level = $this->course->level;
            $this->type = $this->course->type;
            $this->incomingMethod = $this->course->incoming_method_id;
            $this->province = $this->course->province;
            $this->city = $this->course->city;
            $this->time_lapse = $this->course->time_lapse;
            $this->organ_id = $this->course->organ_id;
            $this->poll_id = $this->course->poll_id;

            $this->chapters = $this->course->chapters->toArray();
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

        $this->data['storage'] = getAvailableStorages();

        $this->data['reduction'] = ReductionEnum::getType();
        $this->data['status'] = CourseEnum::getStatus();
        $this->data['type'] = CourseEnum::getTypes();
        $this->data['quiz'] = $this->quizRepository->getAll()->pluck('name','id');
        $this->data['incoming'] = $this->incomingMethodRepository->getAll()->pluck('title','id');
        $this->data['province'] = $this->settingRepository::getProvince();
        $this->data['organs'] = $this->organRepository->getAll()->pluck('title','id');
        $this->data['forms'] = Poll::all()->pluck('title','id');

        $this->data['storage'] = getAvailableStorages();
        $this->data['chapter_status'] = ChapterEnum::getStatus();
    }

    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && in_array($this->province,array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);

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
            $this->reset(['slug','sub_title','title','short_body','long_body','image','category','quiz','teacher',
                'status','level','type','reduction_type','const_price','reduction_value','start_at','expire_at',
                'tags','seo_keywords','seo_description','incomingMethod','province','city','time_lapse','organ_id','poll_id']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->quiz = $this->emptyToNull($this->quiz);
        $this->organ_id = $this->emptyToNull($this->organ_id);
        $this->start_at = $this->dateConverter($this->start_at,'m') ;
        $this->expire_at = $this->dateConverter($this->expire_at,'m') ;
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
            'teacher' => ['required','exists:teachers,id'],
            'const_price' => ['required','between:0,99999999999999.9999','numeric'],
            'status' => ['required','in:'.implode(',',array_keys(CourseEnum::getStatus()))],
            'reduction_type' => ['nullable','in:'.implode(',',array_keys(ReductionEnum::getType()))],
            'reduction_value' => ['required','numeric','between:0,9999999999999999999.99999999999'],
            'start_at' => ['nullable','date'],
            'expire_at' => ['nullable','date'],
            'level' => ['required','in:'.implode(',',array_keys(CourseEnum::getLevels()))],
            'type' => ['required','in:'.implode(',',array_keys(CourseEnum::getTypes()))],
            'incomingMethod' => ['nullable','exists:incoming_methods,id'],
            'province' => ['nullable',Rule::in(array_keys($this->data['province']))],
            'city' => ['nullable',Rule::in(array_keys($this->data['city']))],
            'time_lapse' => ['nullable','string','max:14000'],
            'organ_id' => ['nullable',Rule::in(array_keys($this->data['organs']))],
            'poll_id' => ['nullable',Rule::in(array_keys($this->data['forms']))],
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
            'level' => 'سطح دوره',
            'type' => 'نوع دوره',
            'incomingMethod' => 'روش محاسبه درامد',
            'province' => 'استان',
            'city' => 'شهر',
            'time_lapse' => 'تایم لپس دوره',
            'organ_id' => 'سازمان یا اموزشگاه',
            'poll_id' => 'فرم نظر سنجی',
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
        $model->type = $this->type;
        $model->start_at = $this->start_at;
        $model->expire_at = $this->expire_at;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $model->province = $this->province;
        $model->city = $this->city;
        $model->time_lapse = $this->time_lapse;
        $model->organ_id = $this->organ_id;
        $model->poll_id = $this->poll_id;
        $model->incoming_method_id = emptyToNull($this->incomingMethod);
        $model = $this->courseRepository->save($model);
        $this->tags = array_filter($this->tags);
        if ($this->mode == self::CREATE_MODE)
            $this->courseRepository->attachTags($model,$this->tags);
        elseif ($this->mode == self::UPDATE_MODE)
            $this->courseRepository->syncTags($model,$this->tags);

        $this->course = $model;
        $this->storeChapter(['course' => $model]);
    }

    public function deleteItem()
    {
        $this->authorizing('cancel_courses');
        $this->courseRepository->delete($this->course);
        return redirect()->route('admin.course');
    }





    public function openChapter($key)
    {
        $chapter = [];
        if (isset($this->chapters[$key]) && $chapter = $this->chapters[$key]) {
            $this->chapter_key = $key;
            $this->item_title = $chapter['title'];
            $this->item_status = $chapter['status'];
            $this->description = $chapter['description'];
            $this->item_view = $chapter['view'];
            $this->emitShowModal('chapter');
        }
    }

    public function deleteChapter($key)
    {
        if (isset($this->chapters[$key]['id']) && $id = $this->chapters[$key]['id']) {
            Chapter::destroy($id);
        }

        unset($this->chapters[$key]);
        $this->emitNotify('فصل با موفقیت حذف شد');
    }

    public function saveChapter($action)
    {
        $this->validate([
            'item_title' => ['required','string','max:250'],
            'item_status' => ['required',Rule::in(array_keys(ChapterEnum::getStatus()))],
            'description' => ['nullable','string','max:400'],
            'item_view' => ['required','integer'],
        ],[],[
            'item_title' => 'عنوان',
            'item_status' => 'وضعیت',
            'description' => 'توضیحات',
            'item_view' => 'شماره نمایش ',
        ]);
        if ($action == 'new') {
            $this->chapters[] = [
                'title' => $this->item_title,
                'status' => $this->item_status,
                'description' => $this->description,
                'view' => $this->item_view
            ];
            $this->emitNotify('فصل با موفقت ذخیره شد');
        } elseif ($this->chapter_key == $action) {
            $this->chapters[$this->chapter_key]['title'] = $this->item_title;
            $this->chapters[$this->chapter_key]['status'] = $this->item_status;
            $this->chapters[$this->chapter_key]['description'] = $this->description;
            $this->chapters[$this->chapter_key]['view'] = $this->item_view;
            $this->chapters[$this->chapter_key]['changed'] = true;
            $this->emitHideModal('chapter');
        }

        $this->resetChapter();
        $this->reloadChapters();
    }

    public function reloadChapters()
    {
        $this->chapters = collect($this->chapters)->sortBy('view')->values()->toArray();
    }

    public function resetChapter()
    {
        $this->reset(['item_title','item_status','description','item_view','chapter_key']);
    }

    public function openEpisode($key , $key2)
    {
        $chapter = [];
        if (isset($this->chapters[$key]['episodes'][$key2]) && $episode = $this->chapters[$key]['episodes'][$key2]) {
            $this->epiosde_key = $key2;
            $this->chapter_key = $key;
            $this->item_title = $episode['title'];
            $this->time = $episode['time'];
            $this->free = $episode['free'];
            $this->api_bucket = $episode['api_bucket'];
            $this->file_storage = $episode['file_storage'];
            $this->file = $episode['file'];
            $this->local_video = $episode['local_video'];
            $this->video_storage = $episode['video_storage'];
            $this->allow_show_local_video = $episode['allow_show_local_video'];
            $this->can_homework = $episode['can_homework'];
            $this->homework_storage = $episode['homework_storage'];
            $this->show_api_video = $episode['show_api_video'];
            $this->downloadable_local_video = $episode['downloadable_local_video'];
            $this->description = $episode['description'];
            $this->item_view = $episode['view'];
            $this->emitShowModal('episode');
        }
    }

    public function saveEpisode($action , $chapter_key = null) {
        if (! is_null($chapter_key)) {
            $this->chapter_key = $chapter_key;
        }

        $this->file_storage = $this->emptyToNull($this->file_storage);
        $this->homework_storage = $this->emptyToNull($this->homework_storage);
        $this->video_storage = $this->emptyToNull($this->video_storage);
        $this->validate(
            [
                'item_title' => ['required','string','max:255'],
                'description' => ['required','string','max:1000000'],
                'new_file' => ['nullable','string','max:10000'],
                'new_local_video' => ['nullable','max:255'],
                'api_bucket' => ['nullable','max:35000'],
                'time' => ['required','date_format:H:i:s','max:255'],
                'allow_show_local_video' => ['required','boolean'],
                'item_view' => ['required','integer'],
                'file_storage' => [Rule::requiredIf(fn() => !empty($this->file)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
                'video_storage' => [Rule::requiredIf(fn() => !empty($this->local_video)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
                'homework_storage' => [Rule::requiredIf(fn() => $this->can_homework ==true) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
                'free' => ['boolean'],
                'can_homework' => ['boolean'],
                'downloadable_local_video' => [Rule::requiredIf(fn() => !empty($this->downloadable_local_video)) ,'boolean'],
                'show_api_video' => [Rule::requiredIf(fn() => !empty($this->api_bucket)) ,'boolean'],
            ], [],
            [
                'item_title' => ' عنوان درس',
                'description' => 'توضیحات',
                'new_file' => 'فایل درس',
                'link' => 'لینک درس',
                'new_local_video' => 'ویدئو درس',
                'api_bucket' => 'api',
                'time' => 'زمان درس',
                'file_storage' => 'فضای ذخیره سازی فایل',
                'video_storage' => 'فضای ذخیره سازی ویدئو',
                'homework_storage' => 'فضای ذخیره سازی تمرین',
                'item_view' => 'نمایش درس',
                'allow_show_local_video' => 'اجازه برای نمایش ویدئو',
                'free' => 'رایگان',
                'can_homework' => 'فیلد تمرین',
                'downloadable_local_video' => 'امکان دانلود ویدئو',
                'show_api_video' => 'نمایش ویدئو ',
            ]
        );

        if ($action == 'new') {
            $this->chapters[$this->chapter_key]['episodes'][] = [
                'title' => $this->item_title,
                'description' => $this->description,
                'file' => $this->new_file,
                'link' => $this->link,
                'local_video' => $this->new_local_video,
                'api_bucket' => $this->api_bucket,
                'time' => $this->time,
                'file_storage' => $this->file_storage ?? StorageEnum::PRIVATE,
                'video_storage' =>  $this->video_storage ?? StorageEnum::PRIVATE,
                'homework_storage' => $this->homework_storage ?? StorageEnum::PUBLIC,
                'view' => $this->item_view,
                'allow_show_local_video' => $this->allow_show_local_video,
                'free' => $this->free,
                'can_homework' => $this->can_homework,
                'downloadable_local_video' => $this->downloadable_local_video,
                'show_api_video' => $this->show_api_video,
            ];
            $this->emitNotify('درس با موفقت ذخیره شد');
        } elseif ($action == $this->epiosde_key) {
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['title'] = $this->item_title;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['description'] = $this->description;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['file'] = $this->new_file;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['link'] = $this->link;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['local_video'] = $this->new_local_video;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['api_bucket'] = $this->api_bucket;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['time'] = $this->time;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['file_storage'] = $this->file_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['video_storage'] = $this->video_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['homework_storage'] = $this->homework_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['view'] = $this->item_view;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['allow_show_local_video'] = $this->allow_show_local_video;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['free'] = $this->free;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['can_homework'] = $this->can_homework;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['downloadable_local_video'] = $this->downloadable_local_video;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['show_api_video'] = $this->show_api_video;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['changed'] = true;
            $this->emitHideModal('episode');
        }

        $this->reloadEpisodes();
        $this->resetEpisode();
    }

    public function deleteEpisode($key , $key2)
    {
        if (
            isset($this->chapters[$key]) &&
            isset($this->chapters[$key]['episodes']) &&
            isset($this->chapters[$key]['episodes'][$key2]) &&
            (! $this->transcript || !isset($this->chapters[$key]['episodes'][$key2]['id']))
        ) {
            if (isset($this->chapters[$key]['episodes'][$key2]['id']) && $id = $this->chapters[$key]['episodes'][$key2]['id']) {
                Episode::destroy($id);
            }

            unset($this->chapters[$key]['episodes'][$key2]);
            $this->emitNotify('درس با موفقیت حذف شد');
        }
    }

    public function reloadEpisodes()
    {
        $this->chapters[$this->chapter_key]['episodes'] = collect($this->chapters[$this->chapter_key]['episodes'])->sortBy('view')->values()->toArray();
    }

    public function resetEpisode()
    {
        $this->reset([
            'file_storage','api_bucket','item_title','file','link','local_video','time','item_view',
            'free','allow_show_local_video' , 'homework_storage','chapter_key','epiosde_key',
            'video_storage'  ,'description' ,'can_homework','downloadable_local_video','show_api_video','new_file',
            'has_file' , 'has_video' ,'has_link' ,'has_homework' ,'has_bucket' , 'new_local_video'
        ]);
    }

    public function storeChapter($data) {
        $this->transcript = $data['transcript'] ?? false;
        $this->course = Course::query()->find($data['course']['id']);
        if ($this->transcript) {
            foreach ($this->chapters as $chapter) {
                if (! isset($chapter['id'])) {
                    $new_chapter = ChapterTranscript::query()->create([
                        ... $chapter,
                        'status' => ChapterEnum::TRANSCRIPT_PENDING,
                        'course_id' => $this->course->id
                    ]);
                } elseif (isset($chapter['changed']) && $chapter['changed']) {
                    if (ChapterTranscript::query()->where([
                        ['chapter_id',$chapter['id']],
                        ['status' , ChapterEnum::TRANSCRIPT_PENDING]
                    ])->exists()) {
                        continue;
                    }
                    $new_chapter = ChapterTranscript::query()->create([
                        'status' => ChapterEnum::TRANSCRIPT_PENDING,
                        'course_id' => $this->course->id,
                        'chapter_id' => $chapter['id'],
                        'title' => $chapter['title'],
                        'description' => $chapter['description'],
                        'view' => $chapter['view']
                    ]);
                };

                if (isset($chapter['episodes']) && sizeof($chapter['episodes']) > 0) {
                    foreach ($chapter['episodes'] as $episode) {
                        if (! isset($episode['id'])) {
                            EpisodeTranscript::query()->create([
                                ...$episode,
                                'chapter_id' => $new_chapter['chapter_id'] ?? $chapter['id'] ?? null,
                                'chapter_transcript_id' => $new_chapter['id'] ?? null,
                                'status' => EpisodeEnum::PENDING_STATUS,
                            ]);
                        } elseif(isset($episode['changed']) && $episode['changed']) {
                            if (EpisodeTranscript::query()->where([
                                ['episode_id',$episode['id']],
                                ['status' , EpisodeEnum::PENDING_STATUS]
                            ])->exists()) {
                                continue;
                            }
                            EpisodeTranscript::query()->create([
                                'chapter_id' => $new_chapter['chapter_id'] ?? $chapter['id'] ?? null,
                                'chapter_transcript_id' => $new_chapter['id'] ?? null,
                                'episode_id' => $episode['id'],
                                'status' => EpisodeEnum::PENDING_STATUS,
                                'title' => $episode['title'],
                                'description' => $episode['description'],
                                'file' => $episode['file'],
                                'link' => $episode['link'],
                                'local_video' => $episode['local_video'],
                                'api_bucket' => $episode['api_bucket'],
                                'time' => $episode['time'],
                                'file_storage' => $episode['file_storage'] ?? StorageEnum::PUBLIC,
                                'video_storage' =>  $episode['video_storage'] ?? StorageEnum::PUBLIC,
                                'homework_storage' => $episode['homework_storage'] ?? StorageEnum::PUBLIC,
                                'view' => $episode['view'],
                                'allow_show_local_video' => $episode['allow_show_local_video'],
                                'free' => $episode['free'],
                                'can_homework' => $episode['can_homework'],
                                'downloadable_local_video' => $episode['downloadable_local_video'],
                                'show_api_video' => $episode['show_api_video'],
                            ]);
                        }
                    }
                }
            }
        } else {
            foreach ($this->chapters as $chapter) {

                if (! isset($chapter['id'])) {
                    $new_chapter = $this->course->chapters()->create($chapter);
                } else {
                    $this->course->chapters()->where('id',$chapter['id'])->update([
                        'title' => $chapter['title'],
                        'status' => $chapter['status'],
                        'description' => $chapter['description'],
                        'view' => $chapter['view']
                    ]);
                    $new_chapter = $chapter;
                }
                if (isset($chapter['episodes']) && sizeof($chapter['episodes']) > 0) {
                    foreach ($chapter['episodes'] as $episode) {
                        if (! isset($episode['id'])) {
                            Episode::query()->create([...$episode,'chapter_id' => $new_chapter['id']]);
                        } else {
                            Episode::query()->where('id',$episode['id'])->update([
                                'title' => $episode['title'],
                                'description' => $episode['description'],
                                'file' => $episode['file'],
                                'link' => $episode['link'],
                                'local_video' => $episode['local_video'],
                                'api_bucket' => $episode['api_bucket'],
                                'time' => $episode['time'],
                                'file_storage' => $episode['file_storage'] ?? StorageEnum::PUBLIC,
                                'video_storage' =>  $episode['video_storage'] ?? StorageEnum::PUBLIC,
                                'homework_storage' => $episode['homework_storage'] ?? StorageEnum::PUBLIC,
                                'view' => $episode['view'],
                                'allow_show_local_video' => $episode['allow_show_local_video'],
                                'free' => $episode['free'],
                                'can_homework' => $episode['can_homework'],
                                'downloadable_local_video' => $episode['downloadable_local_video'],
                                'show_api_video' => $episode['show_api_video'],
                            ]);
                        }
                    }
                }
            }
        }
        $course = $this->course;
        $course->load(['chapters','chapters.episodes']);
        $this->chapters = $course->chapters->toArray();
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

}
