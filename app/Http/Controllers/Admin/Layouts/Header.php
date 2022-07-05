<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;

class Header extends BaseComponent
{
    public function mount()
    {
    }
    public function render()
    {
        return view('admin.layouts.header');
    }
}
