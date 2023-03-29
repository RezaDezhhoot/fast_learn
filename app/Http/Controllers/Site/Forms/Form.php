<?php

namespace App\Http\Controllers\Site\Forms;

use App\Enums\FormEnum;
use App\Http\Controllers\BaseComponent;
use App\Http\Controllers\FormBuilder\Facades\FormBuilder;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class Form extends BaseComponent
{
    use WithFileUploads ;

    public $model , $form = [] , $storageConfig , $files , $result = false , $recaptcha;

    public $course , $form_key = 'form';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->formReposirtory = app(FormRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->storageRepository = app(StorageRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }



    public function mount($id , $loadHead = false , $course = null , $form_key = null)
    {
        $this->model = $this->formReposirtory->findOrFail($id,true);

        if (in_array($this->model->subject,[FormEnum::ORGAN,FormEnum::TEACHER,FormEnum::STUDENT,FormEnum::COURSES])) {
            if (!auth()->check()) abort(401);
            if ($this->model->subject == FormEnum::TEACHER && !auth()->user()->hasRole('teacher')) abort(403);
            if ($this->model->subject == FormEnum::ORGAN && !auth()->user()->organs) abort(403);
        }

        if (!is_null($form_key))
            $this->form_key = $form_key;
        else $this->form_key = $this->form_key.'_'.$this->model->name;

        $this->form = $this->model->forms;
        $this->emit('loadRecaptcha');

        $this->course = $course;

        $this->storageConfig = $this->storageRepository->getConfig($this->model->storage);
        if ($loadHead)
            SEOMeta::setTitle($this->settingRepository->getRow('title').' ارسال اطلاعات ');
    }

    public function loadMore()
    {
        $this->emit('loadRecaptcha');
    }

    public function store()
    {
        $this->validate([
            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'recaptcha' => 'کلید امنیتی'
        ]);
        $this->resetErrorBag();
        $storageConfig = $this->storageRepository->getConfig($this->model->storage);
        foreach ($this->form as $key => $item) {
            if ($item['type'] != 'file') {
                if (FormBuilder::isVisible($this->form, $item) && $item['required'] && strlen($item['value']) == 0) {
                    $this->addError('form.' . $key . '.error', __('validation.required', ['attribute' => '']));
                    return;
                }
            } else {
                $this->validate([
                    'form.'.$key.'.value' => [$item['required'] ? 'required': 'nullable','file','max:'.$storageConfig['max_file_size'],'mimes:'.implode(',',$storageConfig['allow_file_types'])]
                ],[],[
                    'form.'.$key.'.value' => 'فایل'
                ]);
            }
        }
        if (sizeof($this->getErrorBag()) > 0) {
            return;
        }

        if ($rateKey = rateLimiter(value: request()->ip().'_'.$this->form_key, decalSeconds: 24 * 60 * 60, max_tries: 3))
        {
            return  $this->emitNotify('زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
        }

        $form = collect($this->form);
        if ($form->contains('type','file')) {
            $disk = getDisk($this->model->storage);
            try {
                foreach ($form->where('type','file') as $key => $item) {
                    if (!is_null($item['value'])) {
                        $this->form[$key]['value'] = $disk->put('forms/'.now()->year.'/'.now()->month.'/'.now()->day, $item['value']);
                    }
                }
            } catch (\Exception $e) {
                report($e);
            }
        }
        try {
            DB::beginTransaction();
            $answer = $this->formReposirtory->answerCreate([
                'form_details' => [
                    'form_title' => $this->model->name,
                    'form_id' => $this->model->id
                ],
                'form_data' => $this->form,
                'subject' => $this->model->subject,
                'user_id' => auth()->check() ? auth()->id() : null,
                'user_ip' => request()->ip(),
                'form_id' => $this->model->id,
                'storage' => $this->model->storage
            ]);
            if ($this->course && auth()->check()) {
                $this->courseRepository->submitRating($this->course,[
                    'user_id' => auth()->id(),
                    'form_id' => $this->model->id,
                    'form_answer_id' => $answer->id
                ]);
            }
            DB::commit();
            $this->emitNotify('اطالاعات با موفقیت ثبت شد');
            $this->result = true;
            $this->reset(['form']);
            $this->emit('resetReCaptcha');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            $this->emitNotify($e->getMessage(),'warning');
        }
    }



    public function render()
    {
        return view('site.forms.form');
    }
}
