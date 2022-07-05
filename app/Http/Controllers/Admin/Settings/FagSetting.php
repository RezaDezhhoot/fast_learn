<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class FagSetting extends BaseComponent
{
    public $header;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function delete($id)
    {
        $this->authorizing('edit_settings_fag');
        $settings = $this->settingRepository->find($id);
        $this->settingRepository->delete($settings);
    }
    public function render()
    {
        $this->authorizing('show_settings_fag');
        $this->header = 'تنظیمات سوالات متداول';
        $questions = $this->settingRepository->getAdminLaw('question');
        return view('admin.settings.fag-setting',['questions' => $questions])
            ->extends('admin.layouts.admin');
    }
}
