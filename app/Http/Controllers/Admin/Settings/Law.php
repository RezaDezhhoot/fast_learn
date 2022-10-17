<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Law extends BaseComponent
{
    public  $apply_law , $header;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_contactUs');
        $this->header = 'تنظیمات  مدرس شوید';
        $this->apply_law = $this->settingRepository->getRow('apply_law');
    }

    public function store()
    {
        $this->authorizing('edit_settings_contactUs');

        $this->validate(
            [
                'apply_law' => ['nullable', 'string','max:600000'],
            ] , [] , [
                'apply_law' => 'توضیخات و قوانین',
            ]
        );

        $this->settingRepository::updateOrCreate(['name' => 'apply_law'], ['value' => $this->apply_law]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.settings.law')->extends('admin.layouts.admin');
    }
}
