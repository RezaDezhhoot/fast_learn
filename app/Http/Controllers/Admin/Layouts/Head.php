<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Head extends BaseComponent
{


    public function mount()
    {

    }

    public function render()
    {
        return view('admin.layouts.head');
    }
}
