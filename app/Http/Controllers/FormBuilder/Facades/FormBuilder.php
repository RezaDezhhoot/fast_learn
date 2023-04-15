<?php

namespace App\Http\Controllers\FormBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class FormBuilder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Http\Controllers\FormBuilder\FormBuilder::class;
    }
}
