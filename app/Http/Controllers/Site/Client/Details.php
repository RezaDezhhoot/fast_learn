<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\Grades;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Rules\ValidNationCode;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Details extends BaseComponent
{
    public $code_id  , $father_name , $birthday , $province , $city , $grade , $identification_code , $study_area;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->userDetailRepository = app(UserDetailRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.' تکمیل پروفایل');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').'-'.' تکمیل پروفایل');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').'-'.' تکمیل پروفایل');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'-'.' تکمیل پروفایل');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));

        $this->data['grade'] = Grades::getItems();
    }

    public function store()
    {
        if (
            preg_match("/^[0-9]{4}-([1-9]|1[0-2])-([1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday) ||
            preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday)
        )
            $this->birthday = Carbon::make($this->birthday)->format('Y-m-d');
        else return $this->addError('birthday','تاریخ تولد با الگوی Y-m-d مطابقت ندارد.');

        $fields = [
            'code_id' => ['required',new ValidNationCode(),'unique:user_details,code_id,'.($this->user->details->id ?? 0)],
            'birthday' => ['required'],
            'grade' => ['required',Rule::in(Grades::getValues())],
            'identification_code' => ['nullable',Rule::exists('users','id')->whereNot('id',auth()->id())],
            'study_area' => ['required','string','max:100']
        ];
        $messages = [
            'code_id' => 'کد ملی',
            'birthday' => 'تاریخ تولد',
            'grade' => 'مقطع تحصیلی',
            'identification_code' => 'کد معرف',
            'study_area' => 'منطقه تحصیلی',
        ];
        $this->validate($fields,[],$messages);
        $this->userDetailRepository->updateOrCreate(['user_id' => auth()->id()],[
            'code_id' => $this->code_id,
            'birthday' => $this->birthday,
            'grade' => $this->grade,
            'study_area' => $this->study_area,
        ]);
        $user = auth()->user();
        $user->identification_code = $this->identification_code;
        $this->userRepository->save($user);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        redirect()->intended(route('user.dashboard'));
    }


    public function render()
    {
        return view('site.client.details')->extends('site.layouts.client.client');
    }
}
