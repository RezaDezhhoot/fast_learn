<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Homework extends BaseComponent
{
    use WithFileUploads;
    public  $homework_file , $file_path , $homework_description , $homework_recaptcha , $homework_show;
    public  $course_data , $chapter_data , $episode_data , $user , $show_homework_form = false;

    private $homework ;

    public $recaptcha;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
    }

    public function mount($course , $chapter , $episode , $show_homework_form)
    {
        $this->episode_data = $episode;
        $this->course_data = $course;
        $this->chapter_data = $chapter;
        $this->show_homework_form = $show_homework_form;
        $this->user = auth()->user();
        $this->homework($episode['id']);
        $this->emit('loadRecaptcha');
    }

    public function loadHomework()
    {
        $this->emit('loadRecaptcha');
    }

    public function homework($id)
    {
        $this->resetHomework();
        if (Auth::check()) {
            $user_has_episode = $this->user->hasCourse($this->course_data->id || auth()->user()->hasRole('admin'));
            if ($this->course_data->price == 0 && !$user_has_episode) {
                $this->courseRepository->setCourseToOrder($this->course_data);
                $this->emitNotify('شما با موفقیت در این دوره ثبت نام شدید.');
            }

            if ($user_has_episode) {
                $this->episode_data = $this->episodeRepository->find($id);
                if (!is_null($this->episode_data) && $this->episode_data->can_homework){
                    $this->homework = $this->homeworkRepository->get([
                        ['user_id',auth()->id()],
                        ['episode_id',$this->episode_data->id]
                    ]);
                    $this->homework_show = $this->homework;
                }
                if (!is_null($this->homework)) {
                    $this->file_path = $this->homework->file;
                    $this->homework_description = $this->homework->description;
                } else {
                    $this->emit('loadRecaptcha');
                }
            }
        }
    }

    public function delete_homework()
    {
        if (Auth::check()) {
            if (!is_null($this->episode_data) && !is_null($this->homework_show)) {
                $this->homeworkRepository->destroy($this->homework_show->id);
                $this->resetHomework();
                $this->emitNotify('تمرین با موفقیت حذف شد');
            }
        }

    }

    public function submit_homework()
    {
        if (Auth::check()) {
            if ($rateKey = rateLimiter(value:Auth::id().'_homework_submit_'.$this->course_data->id,max_tries: 50))
            {
                $this->show_homework_form = false;
                return $this->emitNotify('زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
            }
            $user_has_episode = $this->user->hasCourse($this->course_data->id) || auth()->user()->hasRole('admin');
            if ($user_has_episode) {
                if (!is_null($this->episode_data) && is_null($this->homework)) {
                    $this->validate([
                        'homework_file' => ['required','file','mimes:jpg,jpeg,png,PNG,JPG,JPEG,rar,zip','max:2048'],
                        'homework_description' => ['nullable','string','max:240'],
                        'homework_recaptcha' => ['required', new ReCaptchaRule],
                    ],[],[
                        'homework_file' => 'فایل تمرین',
                        'homework_description' => 'توضیحات تمرین',
                        'homework_recaptcha' => 'فیلد امنیتی'
                    ]);
                    $this->uploader();
                    $this->homework = $this->homeworkRepository->updateOrCreate([
                        'episode_id' => $this->episode_data->id,
                        'user_id' => auth()->id()
                    ],[
                        'file' => $this->file_path,
                        'description' => $this->homework_description,
                        'episode_title' => $this->episode_data->title,
                        'storage' => $this->episode_data->homework_storage
                    ]);
                    $this->homework_show = $this->homework;
                    $this->emit('resetReCaptcha');
                    $this->reset(['homework_file','file_path']);
                    $this->emitNotify('تمرین شما با موفقیت ارسال شد');
                } else $this->emitNotify('امکان بارگذاری مجدد تمرین موجود نمی باشد','warning');
            } else $this->emitNotify('شما هنوز این دوره را شروع نکرده اید','warning');
        }
    }

    private function uploader()
    {
        $disk = getDisk($this->episode_data->homework_storage);
        if (!empty($this->homework_file)) {
            $this->file_path = $disk->put('homeworks',$this->homework_file);
        }
    }

    public function updatedHomeworkFile()
    {
        $this->resetErrorBag();
    }

    public function resetHomework()
    {
        $this->reset(['homework_show','homework_file','homework_description','file_path']);
    }

    public function render()
    {
        return view('site.episodes.homework');
    }
}
