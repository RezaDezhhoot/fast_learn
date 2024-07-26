<?php

namespace App\Http\Controllers\Admin\Episodes;

use App\Enums\CategoryEnum;
use App\Enums\EpisodeQuizType;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\EpisodeQuiz;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class StoreEpisode extends BaseComponent
{
    use WithPagination;

    public  $header , $storage , $episode;
    public $title , $link , $time = '00:00:00' , $view = 0, $free = 0 , $api_bucket , $file_storage , $file ,$local_video ,
        $video_storage , $allow_show_local_video = 0 , $course_id , $description , $can_homework = false , $homework_storage ,
        $show_api_video = false , $downloadable_local_video = false , $chapter_id;

    public $homework , $h_file , $h_description , $h_result , $h_storage , $h_score;

    // quiz

    public $quiz , $quiz_title , $quiz_type , $quiz_at , $quiz_timer;

    public $selected_questions , $category , $questions = [] , $selected_questions_id = [] , $total_score = 0 ,
        $selected_questions_list = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_episodes');
        $this->set_mode($action);
        $this->data['storage'] = getAvailableStorages();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        $this->data['chapter'] = [];
        if ($this->mode == self::UPDATE_MODE) {
            $this->episode = $this->episodeRepository->findOrFail($id);
            $this->header = @$this->episode->chapter->course->title." - ".@$this->episode->chapter->title." - ".@$this->episode->title;
            $this->title = $this->episode->title;
            $this->file = $this->episode->file;
            $this->link = $this->episode->link;
            $this->local_video = $this->episode->local_video;
            $this->api_bucket = $this->episode->api_bucket;
            $this->time = $this->episode->time;
            $this->course_id = $this->episode->chapter->course_id ?? null;
            $this->chapter_id = $this->episode->chapter_id;
            $this->view = $this->episode->view;
            $this->description = $this->episode->description;
            $this->can_homework = $this->episode->can_homework;
            $this->homework_storage = $this->episode->homework_storage;
            $this->free = $this->episode->free;
            $this->file_storage = in_array($this->episode->file_storage , array_keys($this->data['storage'])) ? $this->episode->file_storage : $this->storage;
            $this->video_storage = in_array($this->episode->video_storage , array_keys($this->data['storage'])) ? $this->episode->video_storage : $this->storage;
            $this->allow_show_local_video = $this->episode->allow_show_local_video;
            $this->show_api_video = $this->episode->show_api_video;
            $this->downloadable_local_video = $this->episode->downloadable_local_video;
            $this->updateChapters($this->course_id);

        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'درس جدید';
        } else abort(404);

        $this->data['question_categories'] = $this->categoryRepository->getAll(CategoryEnum::QUESTION)->pluck('title','id');
        $this->data['quiz_type'] = EpisodeQuizType::getTypes();
    }

    public function store()
    {
        $this->authorizing('edit_episodes');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->episode);
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->episodeRepository->newEpisodeObject());
            $this->resetEpisodeInputs();
        }
    }

    private function saveInDataBase($episode)
    {
        $this->file_storage = $this->emptyToNull($this->file_storage);
        $this->homework_storage = $this->emptyToNull($this->homework_storage);
        $this->video_storage = $this->emptyToNull($this->video_storage);
        $this->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:1000000'],
            'file' => ['nullable','string','max:10000'],
            'local_video' => ['nullable','max:255'],
            'api_bucket' => ['nullable','max:35000'],
            'time' => ['required','date_format:H:i:s','max:255'],
            'allow_show_local_video' => ['required','boolean'],
            'chapter_id' => ['required','exists:chapters,id'],
            'view' => ['required','integer'],
            'file_storage' => [Rule::requiredIf(fn() => !empty($this->file)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'video_storage' => [Rule::requiredIf(fn() => !empty($this->local_video)) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'homework_storage' => [Rule::requiredIf(fn() => $this->can_homework ==true) ,'in:'.implode(',',array_keys(getAvailableStorages())).','.null],
            'free' => ['boolean'],
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
            'homework_storage' => 'فضای ذخیره سازی تمرین',
            'view' => 'نمایش درس',
            'allow_show_local_video' => 'اجازه برای نمایش ویدئو',
            'chapter_id' => 'فصل',
            'free' => 'رایگان',
            'can_homework' => 'فیلد تمرین',
            'downloadable_local_video' => 'امکان دانلود ویدئو',
            'show_api_video' => 'نمایش ویدئو ',
        ]);

        $episode->title = $this->title;
        $episode->file = $this->file;
        $episode->link =$this->link;
        $episode->local_video = $this->local_video;
        $episode->api_bucket = $this->api_bucket;
        $episode->view =$this->view;
        $episode->time = $this->time;
        $episode->chapter_id = $this->chapter_id;
        $episode->free =$this->free;
        $episode->file_storage = $this->file_storage ;
        $episode->homework_storage = $this->homework_storage;
        $episode->video_storage = $this->video_storage ;
        $episode->allow_show_local_video = $this->allow_show_local_video;

        $episode->description = $this->description;
        $episode->can_homework = $this->can_homework;
        $episode->show_api_video = $this->show_api_video;
        $episode->downloadable_local_video = $this->downloadable_local_video;
        $episode = $this->episodeRepository->save($episode);

        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        $homeworks = [] ;
        $quizzes = [];
        if(!is_null($this->episode) && $this->mode == self::UPDATE_MODE) {
            $homeworks = $this->homeworkRepository->getAllAdmin([['episode_id',$this->episode->id]],$this->per_page);
            $quizzes = $this->episode->quizzes()->get();
        }
        return view('admin.episodes.store-episode',['homeworks'=>$homeworks , 'quizzes' => $quizzes])
            ->extends('admin.layouts.admin');
    }

    public function resetEpisodeInputs()
    {
        $this->reset([
            'file_storage','api_bucket','title','file','link','local_video','time','view',
            'free','allow_show_local_video' , 'homework_storage' ,'chapter_id',
            'video_storage' , 'course_id' ,'description' ,'can_homework','downloadable_local_video','show_api_video'
        ]);
    }

    public function deleteItem()
    {
        $this->authorizing('delete_episodes');
        $this->episodeRepository->destroy($this->episode->id);
        return redirect()->route('admin.episode');
    }

    public function deleteHomeworks($id)
    {
        $this->authorizing('delete_episodes');
        $this->deleteHFile();
        $this->homeworkRepository->destroy($id);
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

    public function updatedCourseId($value)
    {
        $this->updateChapters($value);
    }

    public function updateChapters($value)
    {
        $this->data['chapter'] = $this->chapterRepository->alL('course',$value,'id')->pluck('title','id');
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


    public function updatedSelectedQuestions()
    {
        $QuestionRepository = app(QuestionRepositoryInterface::class);
        $total_score = 0;

        $this->selected_questions_id = array_filter($this->selected_questions);

        $this->selected_questions_list = $QuestionRepository->findMany($this->selected_questions_id);

        foreach ($this->questions as $item){
            if (in_array($item->id,$this->selected_questions_id))
                $total_score = $total_score + $item->score;
        }

        $this->total_score = $total_score;
    }
    public function updatedCategory()
    {
        $questions = [];
        if (!empty($this->category))
            $questions =  app(CategoryRepositoryInterface::class)->find($this->category)->questions;

        $this->questions = $questions;
    }

    public function resetQuiz()
    {
        $this->reset(['quiz','quiz_title','quiz_type','quiz_at','selected_questions','quiz_timer','total_score','category','selected_questions_list']);
    }
    public function opeQuiz($id = null): void
    {
        $this->resetQuiz();
        if ($id) {
            $this->quiz = EpisodeQuiz::query()->find($id);
            $this->quiz_title = $this->quiz->title;
            $this->quiz_at = $this->quiz->at;
            $this->quiz_type = $this->quiz->type;
            $this->quiz_timer = $this->quiz->timer;
            $this->selected_questions = $this->quiz->questions->pluck('id','id')->toArray();
            $this->updatedSelectedQuestions();
            $this->total_score = $this->quiz->total_score;
        }
        $this->emitShowModal('quiz');
    }

    public function storeQuiz(): void
    {
        $this->validate([
            'quiz_title' => ['required','string','max:50'],
            'quiz_timer' => ['required','integer','min:1'],
            'quiz_type' => ['required','string',Rule::in(array_keys($this->data['quiz_type']))],
            'quiz_at' => [$this->quiz_type == EpisodeQuizType::END ? "nullable" : 'required' ,'date_format:H:i:s'],
            'selected_questions' => ['array','min:1'],
        ]);

        $quiz = $this->quiz ?? new EpisodeQuiz();
        $quiz->fill([
            'title' => $this->quiz_title,
            'type' => $this->quiz_type,
            'at' => $this->quiz_at,
            'timer' => $this->quiz_timer,
            'episode_id' => $this->episode->id
        ])->save();

        $quiz->questions()->sync(array_filter($this->selected_questions_id));
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        $this->emitHideModal('quiz');
    }

    public function deleteQuiz($id): void
    {
        EpisodeQuiz::destroy($id);
    }

}
