<?php

namespace App\Http\Controllers\Site\Settings;

use App\Enums\StorageEnum;
use App\Enums\TeacherEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class TeacherRequest extends BaseComponent
{
    use WithFileUploads;
    public $descriptions , $files = [] , $url , $law;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->teacherRequestRepository = app(TeacherRequestRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->disk = getDisk(storage: StorageEnum::PRIVATE);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'- مدرس شوید');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' مدرس شوید -');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->law = $this->settingRepository->getRow('apply_law');
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'fag' => ['link' => '' , 'label' => 'مدرس شوید']
        ];
    }

    public function store()
    {
        if (Auth::user()->applies->where('status',TeacherEnum::APPLY_PENDING)->count() > 0 || Auth::user()->applies->count() > 15) {
            $this->resetData();
            return $this->emitNotify('شما هم اکنون درخواست در حال بررسی دارید','warning');
        }

        if ($rateKey = rateLimiter(value:Auth::id().'_apply',max_tries: 15))
        {
            $this->resetData();
            return
                $this->emitNotify( 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
        }

        $this->validate([
            'descriptions' => ['required','string','max:125000'],
            'files' => ['nullable','array','max:3'],
            'files.*' => ['required','file','max:2048','mimes:png,jpeg,pdf,zip,rar'],
            'url' => ['nullable','url','max:250'],
        ],[],[
            'descriptions' => 'توضیحات',
            'files' => 'فایل های سرفصل و رزومه',
            'files.*' => 'فایل های سرفصل و رزومه',
            'url' => 'ادرس رزومه',
        ]);
        try {
            $this->teacherRequestRepository->newApply([
                'user_id' => Auth::id(),
                'descriptions' => $this->descriptions,
                'url' => $this->url,
                'status' => TeacherEnum::APPLY_PENDING,
                'files' => $this->uploadFiles(),
                'result' => ''
            ]);
            $this->resetData();
            redirect()->route('user.requests');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->emitNotify('خظایی در هنکام ارسال درخواست رخ داده است','warning');
        }
    }

    public function resetData()
    {
        $this->reset(['descriptions','url','files']);
    }

    private function uploadFiles(): string
    {
        $file = [];
        foreach ($this->files as $value) {
            if (isset($value) && !empty($value))
                $file[] = $this->disk->put('applies/'.Auth::user()->name, $value);
        }

        return implode(',',$file);
    }

    public function addFile()
    {
        if (sizeof($this->files) < 3)
            $this->files[] = '';
    }

    public function deleteFile($key)
    {
        unset($this->files[$key]);
    }

    public function render()
    {
        return view('site.settings.teacher-request')->extends('site.layouts.site.site');
    }
}
