<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\ChapterEnum;
use App\Enums\EpisodeEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Chapter;
use App\Models\ChapterTranscript;
use App\Models\Course;
use App\Models\Episode;
use App\Models\EpisodeTranscript;
use Illuminate\Validation\Rule;

class Content extends BaseComponent
{
    private $transcript;

    public $transcript_view;

    public $course , $chapters = [];

    public $header  , $slug , $title , $status , $description , $view;

    public $chapter_key;

    public $epiosde_key;

    public  $link , $time = '00:00:00' , $free = 0 , $api_bucket , $file_storage , $file ,$local_video ,
        $video_storage , $allow_show_local_video = 0   , $can_homework = false , $homework_storage ,
        $show_api_video = false , $downloadable_local_video = false ;

    protected $listeners = ['storeChapters' => 'store'];

    public function mount($course = null , $transcript = false)
    {
        $this->transcript = $transcript;
        $this->transcript_view = $transcript;

        if ($course) {
            $this->course = $course;
            $this->chapters = $course->chapters->toArray();
        }
        $this->data['storage'] = getAvailableStorages();

        $this->data['status'] = ChapterEnum::getStatus();
    }

    public function openChapter($key)
    {
        $chapter = [];
        if (isset($this->chapters[$key]) && $chapter = $this->chapters[$key]) {
            $this->chapter_key = $key;
            $this->title = $chapter['title'];
            $this->status = $chapter['status'];
            $this->description = $chapter['description'];
            $this->view = $chapter['view'];
            $this->emitShowModal('chapter');
        }
    }

    public function deleteChapter($key)
    {
        if (isset($this->chapters[$key]) && ! $this->transcript) {
            if (isset($this->chapters[$key]['id']) && $id = $this->chapters[$key]['id']) {
                Chapter::destroy($id);
            }

            unset($this->chapters[$key]);
            $this->emitNotify('فصل با موفقیت حذف شد');
        }
    }

    public function saveChapter($action)
    {
        $this->validate([
            'title' => ['required','string','max:250'],
            'status' => ['required',Rule::in(array_keys(ChapterEnum::getStatus()))],
            'description' => ['nullable','string','max:400'],
            'view' => ['required','integer'],
        ],[],[
            'title' => 'عنوان',
            'status' => 'وضعیت',
            'description' => 'توضیحات',
            'view' => 'شماره نمایش ',
        ]);
        if ($action == 'new') {
            $this->chapters[] = [
                'title' => $this->title,
                'status' => $this->status,
                'description' => $this->description,
                'view' => $this->view
            ];
            $this->emitNotify('فصل با موفقت ذخیره شد');
        } elseif ($this->chapter_key == $action) {
            $this->chapters[$this->chapter_key]['title'] = $this->title;
            $this->chapters[$this->chapter_key]['status'] = $this->status;
            $this->chapters[$this->chapter_key]['description'] = $this->description;
            $this->chapters[$this->chapter_key]['view'] = $this->view;
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
        $this->reset(['title','status','description','view','chapter_key']);
    }

    public function openEpisode($key , $key2)
    {
        $chapter = [];
        if (isset($this->chapters[$key]['episodes'][$key2]) && $episode = $this->chapters[$key]['episodes'][$key2]) {
            $this->epiosde_key = $key2;
            $this->chapter_key = $key;
            $this->title = $episode['title'];
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
            $this->view = $episode['view'];
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
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:1000000'],
            'file' => ['nullable','string','max:10000'],
            'local_video' => ['nullable','max:255'],
            'api_bucket' => ['nullable','max:35000'],
            'time' => ['required','date_format:H:i:s','max:255'],
            'allow_show_local_video' => ['required','boolean'],
            'view' => ['required','integer'],
            'file_storage' => [Rule::requiredIf(fn() => !empty($this->file)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'video_storage' => [Rule::requiredIf(fn() => !empty($this->local_video)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'homework_storage' => [Rule::requiredIf(fn() => $this->can_homework ==true) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'free' => ['boolean'],
            'can_homework' => ['boolean'],
            'downloadable_local_video' => [Rule::requiredIf(fn() => !empty($this->downloadable_local_video)) ,'boolean'],
            'show_api_video' => [Rule::requiredIf(fn() => !empty($this->api_bucket)) ,'boolean'],
        ], [],
            [
            'title' => ' عنوان درس',
            'description' => 'توضیحات',
            'file' => 'فایل درس',
            'link' => 'لینک درس',
            'local_video' => 'ویدئو درس',
            'api_bucket' => 'api',
            'time' => 'زمان درس',
            'file_storage' => 'فضای ذخیره سازی فایل',
            'video_storage' => 'فضای ذخیره سازی ویدئو',
            'homework_storage' => 'فضای ذخیره سازی تمرین',
            'view' => 'نمایش درس',
            'allow_show_local_video' => 'اجازه برای نمایش ویدئو',
            'free' => 'رایگان',
            'can_homework' => 'فیلد تمرین',
            'downloadable_local_video' => 'امکان دانلود ویدئو',
            'show_api_video' => 'نمایش ویدئو ',
        ]
        );

        if ($action == 'new') {
            $this->chapters[$this->chapter_key]['episodes'][] = [
                'title' => $this->title,
                'description' => $this->description,
                'file' => $this->file,
                'link' => $this->link,
                'local_video' => $this->local_video,
                'api_bucket' => $this->api_bucket,
                'time' => $this->time,
                'file_storage' => $this->file_storage ?? StorageEnum::PRIVATE,
                'video_storage' =>  $this->video_storage ?? StorageEnum::PRIVATE,
                'homework_storage' => $this->homework_storage ?? StorageEnum::PUBLIC,
                'view' => $this->view,
                'allow_show_local_video' => $this->allow_show_local_video,
                'free' => $this->free,
                'can_homework' => $this->can_homework,
                'downloadable_local_video' => $this->downloadable_local_video,
                'show_api_video' => $this->show_api_video,
            ];
            $this->emitNotify('درس با موفقت ذخیره شد');
        } elseif ($action == $this->epiosde_key) {
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['title'] = $this->title;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['description'] = $this->description;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['file'] = $this->file;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['link'] = $this->link;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['local_video'] = $this->local_video;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['api_bucket'] = $this->api_bucket;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['time'] = $this->time;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['file_storage'] = $this->file_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['video_storage'] = $this->video_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['homework_storage'] = $this->homework_storage;
            $this->chapters[$this->chapter_key]['episodes'][$this->epiosde_key]['view'] = $this->view;
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
            isset($this->chapters[$key]['episodes'][$key]) &&
            ! $this->transcript
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
            'file_storage','api_bucket','title','file','link','local_video','time','view',
            'free','allow_show_local_video' , 'homework_storage','chapter_key','epiosde_key',
            'video_storage'  ,'description' ,'can_homework','downloadable_local_video','show_api_video'
        ]);
    }

    public function store($data) {
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

    public function render()
    {
        return view('admin.courses.content');
    }
}
