<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class OrganRequest extends BaseComponent
{
    public $model_id;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $id = $this->settingRepository->getRow('organ_form');
        if (!empty($id)) {
            $this->model_id = $id;
        }  else abort(503);
    }

    public function render()
    {
        return view('site.client.organ-request')
            ->extends('site.layouts.client.client');
    }
}
