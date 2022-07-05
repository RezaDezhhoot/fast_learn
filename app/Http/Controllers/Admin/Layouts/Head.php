<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Head extends BaseComponent
{
    public $logo;

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->logo = $settingRepository->getRow('logo');
    }

    public function render()
    {
        return view('admin.layouts.head');
    }
}
