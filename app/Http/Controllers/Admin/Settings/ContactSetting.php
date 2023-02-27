<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class ContactSetting extends BaseComponent
{
    public $header , $googleMap  , $contactText , $tel, $subject = [] , $email, $address;
    public $instagram , $twitter , $youtube , $telegram;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_contactUs');
        $this->header = 'تنظیمات ارتباط با ما';
        $this->googleMap = $this->settingRepository->getRow('googleMap');
        $this->contactText = $this->settingRepository->getRow('contactText');
        $this->tel = $this->settingRepository->getRow('tel');
        $this->email = $this->settingRepository->getRow('email');
        $this->address = $this->settingRepository->getRow('address');
        $this->instagram = $this->settingRepository->getRow('instagram');
        $this->twitter = $this->settingRepository->getRow('twitter');
        $this->youtube = $this->settingRepository->getRow('youtube');
        $this->telegram = $this->settingRepository->getRow('telegram');
        $this->subject = $this->settingRepository->getRow('subject',[]);
    }

    public function render()
    {
        return view('admin.settings.contact-setting')
            ->extends('admin.layouts.admin');
    }

    public function store()
    {
        $this->authorizing('edit_settings_contactUs');
        $this->validate(
            [
                'googleMap' => ['nullable', 'string','max:1000000'],
                'contactText' => ['nullable','string','max:10000'],
                'tel' => ['required','string','max:40'],
                'address' => ['required','string','max:250'],
                'email' => ['required','email','max:150'],
                'instagram' => ['nullable','string','max:300'],
                'twitter' => ['nullable','string','max:400'],
                'youtube' => ['nullable','string','max:400'],
                'telegram' => ['nullable','string','max:400'],
                'subject' => ['nullable','array'],
                'subject.*' => ['required','string','max:70'],
            ] , [] , [
                'googleMap' => 'شناسه گوگل مپ',
                'contactText' => 'متن',
                'tel' => 'تلفن',
                'address' => 'ادرس',
                'email' => 'ایمیل',
                'instagram' => 'اینستاگرام',
                'twitter' => 'توییتر',
                'youtube' => 'یوتیوب',
                'telegram' => 'تلگرام',
                'subject' => 'موضوع ها',
                'subject.*' => 'موضوع ها',
            ]
        );
        $this->settingRepository::updateOrCreate(['name' => 'googleMap'],['value' => $this->googleMap]);
        $this->settingRepository::updateOrCreate(['name' => 'contactText'],['value' => $this->contactText]);
        $this->settingRepository::updateOrCreate(['name' => 'instagram'], ['value' => $this->instagram]);
        $this->settingRepository::updateOrCreate(['name' => 'twitter'], ['value' => $this->twitter]);
        $this->settingRepository::updateOrCreate(['name' => 'youtube'], ['value' => $this->youtube]);
        $this->settingRepository::updateOrCreate(['name' => 'telegram'], ['value' => $this->telegram]);
        $this->settingRepository::updateOrCreate(['name' => 'tel'], ['value' => $this->tel]);
        $this->settingRepository::updateOrCreate(['name' => 'email'], ['value' => $this->email]);
        $this->settingRepository::updateOrCreate(['name' => 'address'], ['value' => $this->address]);
        $this->settingRepository::updateOrCreate(['name' => 'subject'], ['value' => json_encode($this->subject)]);

        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteSubject($key)
    {
        unset($this->subject[$key]);
    }

    public function addSubject()
    {
        $this->subject[] = '';
    }
}
