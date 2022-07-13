<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;

class Homeworks extends BaseComponent
{
    public $show_homework_form = true ,$user , $episode , $homework;
    public  $file_path , $homework_file , $homework_description , $homework_recaptcha;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'-'.' تمرین های من');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.' تمرین های من');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.' تمرین های من');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.' تمرین های من');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->user = Auth::user();
    }

    public function render(HomeworkRepositoryInterface $homeworkRepository)
    {
        $homeworks = $homeworkRepository->get([['user_id',auth()->id()]],'cursor');
        return view('site.client.homeworks',['homeworks'=>$homeworks])->extends('site.layouts.client.client');
    }

    public function homework($id)
    {
        if ($rateKey = rateLimiter(value:Auth::id().'_homework_panel_'.$id,max_tries: 25))
        {
            $this->show_homework_form = false;
            return $this->emitNotify('زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
        }
        $this->homework = $this->homeworkRepository->get([
            ['user_id',auth()->id()],
            ['id',$id]
        ]);
        if (!is_null($this->homework)) {
            $this->file_path = $this->homework->file;
            $this->homework_description = $this->homework->description;
        }
    }

    public function delete_homework()
    {
        if ( !is_null($this->homework) && empty($this->homework->result)) {
            $this->homeworkRepository->destroy($this->homework->id);
            $this->reset(['homework','homework_file','homework_description','file_path']);
            $this->show_homework_form = false;
            $this->emitNotify('تمرین با موفقیت حذف شد');
        }

    }

    public function updatedHomeworkFile()
    {
        $this->resetErrorBag();
    }
}
