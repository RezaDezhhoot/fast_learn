<?php

namespace App\Http\Controllers\Site\Settings;

use App\Enums\ContactUsEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\NoReturn;

class Contact extends BaseComponent
{
    public $tel , $address , $email , $google , $contact;
    public $instagram , $twitter , $youtube , $telegram;

    public $full_name , $contact_email , $phone , $body , $recaptcha;

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' - ارتطبات با ما ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' ارتطبات با ما -');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->address = $settingRepository->getRow('address');
        $this->email = $settingRepository->getRow('email');
        $this->tel = $settingRepository->getRow('tel');
        $this->contact = $settingRepository->getRow('contactText');
        $this->google = $settingRepository->getRow('googleMap');
        $this->instagram = $settingRepository->getRow('instagram');
        $this->twitter = $settingRepository->getRow('twitter');
        $this->youtube = $settingRepository->getRow('youtube');
        $this->telegram = $settingRepository->getRow('telegram');
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'فکور'],
            'contact' => ['link' => '' , 'label' => 'ارتباط با ما']
        ];

        if (Auth::check()) {
            $this->full_name = Auth::user()->name;
            $this->contact_email = Auth::user()->email;
            $this->phone = Auth::user()->phone;
        }
    }
    public function render()
    {
        return view('site.settings.contact')->extends('site.layouts.site.site');
    }

    #[NoReturn]
    public function contact(ContactUsRepositoryInterface $contactUsRepository)
    {
        $this->validate([
            'full_name' => ['required','string','max:120'],
            'contact_email' => ['required','string','email','max:120'],
            'phone' => ['required','string','size:11'],
            'body' => ['required','string','max:1475'],
            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'full_name' => 'نام کامل',
            'contact_email' => 'ادرس ایمیل',
            'phone' => 'شماره همراه',
            'body' => 'متن ارسالی',
            'recaptcha' => 'امنیتی'
        ]);
        if (rateLimiter(value: request()->ip().'_contact_us',max_tries: 3))
        {
            $this->emit('resetReCaptcha');
            $this->reset(['body','recaptcha']);
            return $this->emitNotify('زیادی تلاش کردید پس از مدتی مجدد تلاش کنید','warning');
        }

        try {
            $contactUsRepository->create([
                'full_name' => $this->full_name,
                'email' => $this->contact_email,
                'phone' => $this->phone,
                'body' => $this->body,
                'status' => ContactUsEnum::PENDING
            ]);
            $this->emitNotify('درخواست با موفقیت ثبت شد');
            $this->emit('resetReCaptcha');
            $this->reset(['body']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->emitNotify('خطا در هنگام ارسال درخواست','warning');
        }

    }
}
