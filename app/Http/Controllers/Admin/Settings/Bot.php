<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Models\Setting;

class Bot extends BaseComponent
{
    public $school_amount = 0 , $default_work_shop_amount = 0;

    public function mount(): void
    {
        $this->school_amount = Setting::getSingleRow('school_amount' , 0);
        $this->default_work_shop_amount = Setting::getSingleRow('default_work_shop_amount' , 0);
    }

    public function store()
    {
        $this->validate([
            'school_amount' => ['required', 'integer','between:0,1000000000'],
            'default_work_shop_amount' => ['required', 'integer','between:0,1000000000'],
        ],[] , [
            'school_amount' => 'مبلغ روزانه آموزشگاه',
            'default_work_shop_amount' => 'مبلغ پیشفرض روزانه کارگاه',
        ]);
        Setting::updateOrCreate(['name' => 'school_amount'], ['value' => $this->school_amount]);
        Setting::updateOrCreate(['name' => 'default_work_shop_amount'], ['value' => $this->default_work_shop_amount]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.settings.bot')->extends('admin.layouts.admin');
    }
}
