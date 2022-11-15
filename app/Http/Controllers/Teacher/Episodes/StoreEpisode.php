<?php

namespace App\Http\Controllers\Teacher\Episodes;

use App\Enums\EpisodeEnum;
use App\Enums\LastActivitiesEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\TeacherCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreEpisode extends BaseComponent
{
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->episodeTranscriptRepository = app(EpisodeTranscriptRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
        $this->lastActivityRepository = app(LastActivityRepositoryInterface::class);
    }

    public  $header , $storage , $episode;
    public $title , $link , $time = '00:00:00' , $view = 0, $free = 0 , $api_bucket , $file_storage , $file ,$local_video ,
        $video_storage , $allow_show_local_video = 0 , $course_id , $description , $can_homework = false , $homework_storage ,
        $show_api_video = false , $downloadable_local_video = false;

    public $homework , $h_file , $h_description , $h_result , $h_storage , $h_score;

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        $this->data['storage'] = getAvailableStorages();
        $this->data['course'] = Auth::user()->teacher->courses->pluck('title','id');
        if ($this->mode == self::UPDATE_MODE) {
            $this->episode = $this->episodeRepository->findTeacherEpisode($id);
            $this->header = " درس {$this->episode->title} از {$this->episode->course->title} ";
            $this->title = $this->episode->title;
            $this->file = $this->episode->file;
            $this->link = $this->episode->link;
            $this->local_video = $this->episode->local_video;
            $this->api_bucket = $this->episode->api_bucket;
            $this->time = $this->episode->time;
            $this->course_id = $this->episode->course_id;
            $this->view = $this->episode->view;
            $this->description = $this->episode->description;
            $this->can_homework = $this->episode->can_homework;
            $this->homework_storage = $this->episode->homework_storage;
            $this->file_storage = in_array($this->episode->file_storage , array_keys($this->data['storage'])) ? $this->episode->file_storage : $this->storage;
            $this->video_storage = in_array($this->episode->video_storage , array_keys($this->data['storage'])) ? $this->episode->video_storage : $this->storage;
            $this->allow_show_local_video = $this->episode->allow_show_local_video;
            $this->show_api_video = $this->episode->show_api_video;
            $this->downloadable_local_video = $this->episode->downloadable_local_video;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'درس جدید';
        } else abort(404);
    }

    public function render()
    {
        $homeworks = [];
        if(!is_null($this->episode) && $this->mode == self::UPDATE_MODE)
            $homeworks = $this->homeworkRepository->getAllAdmin([['episode_id',$this->episode->id]],$this->per_page);
        return view('teacher.episodes.store-episode',['homeworks'=>$homeworks])
            ->extends('teacher.layouts.teacher');
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE) {
            if (is_null($this->episode->transcripts) || $this->episode->transcripts->where('status',EpisodeEnum::PENDING_STATUS)->count() == 0) {
                $this->saveInDataBase($this->episodeTranscriptRepository->getNewObject());
                redirect()->route('teacher.episodes',['tab'=>IndexEpisode::TRANSCRIPTS]);
            } else
                $this->emitNotify('برای این درس رونوشت در حال بررسی وجود دارد','warning');
        }
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->episodeTranscriptRepository->getNewObject());
            redirect()->route('teacher.episodes',['tab'=>IndexEpisode::TRANSCRIPTS]);
        }
    }

    private function saveInDataBase($episode)
    {
        $this->file_storage = $this->emptyToNull($this->file_storage);
        $this->homework_storage = $this->emptyToNull($this->homework_storage);
        $this->video_storage = $this->emptyToNull($this->video_storage);
        $this->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:70'],
            'file' => ['nullable','string','max:10000'],
            'local_video' => ['nullable','max:255'],
            'api_bucket' => ['nullable','max:35000'],
            'time' => ['required','date_format:H:i:s','max:255'],
            'allow_show_local_video' => ['required','boolean'],
            'course_id' => ['required','exists:courses,id',new TeacherCourse()],
            'view' => ['required','integer'],
            'file_storage' => [Rule::requiredIf(fn() => !empty($this->file)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'video_storage' => [Rule::requiredIf(fn() => !empty($this->local_video)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'can_homework' => ['boolean'],
            'downloadable_local_video' => [Rule::requiredIf(fn() => !empty($this->downloadable_local_video)) ,'boolean'],
            'show_api_video' => [Rule::requiredIf(fn() => !empty($this->api_bucket)) ,'boolean'],
        ],[],[
            'title' => ' عنوان درس',
            'description' => 'توضیحات',
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
            'can_homework' => 'فیلد تمرین',
            'downloadable_local_video' => 'امکان دانلود ویدئو',
            'show_api_video' => 'نمایش ویدئو ',
        ]);
        $episode->status = EpisodeEnum::PENDING_STATUS;
        $episode->title = $this->title;
        $episode->file = $this->file;
        $episode->link =$this->link;
        $episode->local_video = $this->local_video;
        $episode->api_bucket = $this->api_bucket;
        $episode->view =$this->view;
        $episode->time = $this->time;
        $episode->course_id =$this->course_id;
        $episode->episode_id = $this->mode == self::UPDATE_MODE ? $this->episode->id : null;
        $episode->file_storage = $this->file_storage ?? StorageEnum::PRIVATE;
        $episode->video_storage = $this->video_storage ?? StorageEnum::PRIVATE;
        $episode->allow_show_local_video = $this->allow_show_local_video;
        $episode->description = $this->description;
        $episode->can_homework = $this->can_homework;
        $episode->show_api_video = $this->show_api_video;
        $episode->downloadable_local_video = $this->downloadable_local_video;
        $episode = $this->episodeTranscriptRepository->save($episode);

        if ($this->mode == self::UPDATE_MODE) {
            $url = route('teacher.store.episodes',['edit', $this->episode->id]);
            $event = 'update';
        } else {
            $url = route('teacher.episodes');
            $event = 'new';
        }

        $this->lastActivityRepository->register_activity([
            'user_id' => Auth::id(),
            'subject' => LastActivitiesEnum::appendTitle(LastActivitiesEnum::EPISODES,$event,$episode->title),
            'url' => $url,
            'icon' => LastActivitiesEnum::EPISODES['icon']
        ]);


        return $this->emitNotify('رونوشت با موفقیت ثبت شد');
    }



    public function openHomework($id)
    {
        $this->resetHomework();
        $this->homework = $this->homeworkRepository->get([['id',$id],['episode_id',$this->episode->id]]);
        $this->h_file = $this->homework->file;
        $this->h_description = $this->homework->description;
        $this->h_result = $this->homework->result;
        $this->h_score = $this->homework->score;
        $this->h_storage = $this->homework->storage;
        $this->emitShowModal('homework');
    }

    public function storeHomework()
    {
        $this->validate([
            'h_result' => ['nullable','string','max:10000'],
            'h_score' => ['required','integer','between:1,5']
        ],[],[
            'h_result' => 'توضیحات مدرس',
            'h_score' => 'امتیاز'
        ]);
        $this->homework->result = $this->emptyToNull($this->h_result);
        $this->homework->score = $this->h_score;
        $this->homeworkRepository->save($this->homework);
        $this->emitHideModal('homework');
        $this->resetHomework();
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function resetHomework()
    {
        $this->reset(['homework','h_file','h_description','h_result','h_score','h_storage']);
    }

    public function deleteHFile()
    {
        if (!empty($this->h_storage) && !empty($this->homework) && !empty($this->h_file)) {
            $disk = getDisk($this->h_storage);
            if ($disk->exists($this->h_file))
            {
                $disk->delete($this->h_file);
                $this->homework->file = null;
                $this->h_file = null;
                $this->homeworkRepository->save($this->homework);
                $this->emitNotify('فایل با موفقیت حذف شد');
            }
        }
    }

    public function download()
    {
        if (!empty($this->h_storage) && !empty($this->homework) && !empty($this->h_file)) {
            $disk = getDisk($this->h_storage);
            if ($disk->exists($this->h_file))
                return $disk->download($this->h_file);
        }
    }
}
