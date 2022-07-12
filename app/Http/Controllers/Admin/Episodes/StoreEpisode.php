<?php

namespace App\Http\Controllers\Admin\Episodes;

use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\Component;

class StoreEpisode extends BaseComponent
{
    public  $header , $storage , $episode;

    public $title , $link , $time = '00:00:00' , $view = 0, $free = 0 , $api_bucket , $file_storage , $file ,$local_video ,
        $video_storage , $allow_show_local_video = 0 , $course_id;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->storage = $this->settingRepository->getRow('storage') ?? StorageEnum::PRIVATE;
        $this->disk = getDisk(storage:$this->storage);
    }

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        $this->data['storage'] = array_flip(getAvailableStorages());
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        if ($this->mode == self::UPDATE_MODE) {
            $this->episode = $this->episodeRepository->findOrFail($id);
            $this->header = " درس {$this->episode->title} از {$this->episode->course->title} ";
            $this->title = $this->episode->title;
            $this->file = $this->episode->file;
            $this->link = $this->episode->link;
            $this->local_video = $this->episode->local_video;
            $this->api_bucket = $this->episode->api_bucket;
            $this->time = $this->episode->time;
            $this->course_id = $this->episode->course_id;
            $this->view = $this->episode->view;
            $this->free = $this->episode->free;
            $this->file_storage = in_array($this->episode->file_storage , array_keys($this->data['storage'])) ? $this->episode->file_storage : $this->storage;
            $this->video_storage = in_array($this->episode->video_storage , array_keys($this->data['storage'])) ? $this->episode->video_storage : $this->storage;
            $this->allow_show_local_video = $this->episode->allow_show_local_video;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'درس جدید';
        } else abort(404);
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->episode);
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->episodeRepository->newEpisodeObject());
            $this->resetEpisodeInputs();
        }
    }

    private function saveInDataBase($episode)
    {
        $this->validate([
            'title' => ['required','string','max:255'],
            'file' => ['nullable','string','max:10000'],
            'local_video' => ['nullable','max:255'],
            'api_bucket' => ['nullable','max:35000'],
            'time' => ['required','date_format:H:i:s','max:255'],
            'allow_show_local_video' => ['required','boolean'],
            'course_id' => ['required','exists:courses,id'],
            'view' => ['required','integer'],
            'file_storage' => [Rule::requiredIf(fn() => !empty($this->file)) ,'in:'.implode(',',array_values(getAvailableStorages())).','.null],
            'video_storage' => [Rule::requiredIf(fn() => !empty($this->local_video)) ,'in:'.implode(',',array_values(getAvailableStorages())).','.null],
            'free' => ['boolean'],
        ],[],[
            'title' => ' عنوان درس',
            'file' => 'فایل درس',
            'link' => 'لینک درس',
            'local_video' => 'ویدئو درس',
            'api_bucket' => 'api',
            'time' => 'زمان درس',
            'file_storage' => 'فضای ذخیره سازی فایل',
            'video_storage' => 'فضای ذخیره سازی ویدئو',
            'view' => 'نمایش درس',
            'allow_show_local_video' => 'اجازه برای نمایش ویدئو',
            'course_id' => 'دوره اموزشی',
            'free' => 'رایگان',
        ]);

        $episode->title = $this->title;
        $episode->file = $this->file;
        $episode->link =$this->link;
        $episode->local_video = $this->local_video;
        $episode->api_bucket = $this->api_bucket;
        $episode->view =$this->view;
        $episode->time = $this->time;
        $episode->course_id =$this->course_id;
        $episode->free =$this->free;
        $episode->file_storage = $this->file_storage;
        $episode->video_storage = $this->video_storage;
        $episode->allow_show_local_video = $this->allow_show_local_video;
        $this->episodeRepository->save($episode);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.episodes.store-episode')
            ->extends('admin.layouts.admin');
    }

    public function resetEpisodeInputs()
    {
        $this->reset([
            'file_storage','api_bucket','title','file','link','local_video','time','view',
            'free','allow_show_local_video' ,
            'video_storage' , 'course_id'
        ]);
    }

    public function deleteItem($id)
    {
        $this->episodeRepository->destroy($id);
        return redirect()->route('admin.episode');
    }
}
