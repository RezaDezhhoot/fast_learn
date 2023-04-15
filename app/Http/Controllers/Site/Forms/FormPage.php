<?php

namespace App\Http\Controllers\Site\Forms;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\FormRepositoryInterface;

class FormPage extends BaseComponent
{
    public $model_id;
    public function mount($id)
    {
        $this->model_id = $id;
    }


    public function render()
    {
        return view('site.forms.form-page')
            ->extends('site.layouts.site.site');
    }
}
