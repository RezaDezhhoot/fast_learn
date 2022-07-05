<?php

namespace App\Http\Controllers\Admin\Certificates;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StoreCertificate extends BaseComponent
{
    public object $certificate;
    public $header , $name , $title  , $logo , $bg_image , $autograph_image , $border_image ,$demo;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->certificateRepository = app(CertificateRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_certificates');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->certificate = $this->certificateRepository->find($id);
            $this->name = $this->certificate->name;
            $this->title = $this->certificate->title;
            $this->logo = $this->certificate->logo;
            $this->bg_image = $this->certificate->bg_image;
            $this->autograph_image = $this->certificate->autograph_image;
            $this->border_image = $this->certificate->border_image;
            $this->header = $this->name;
            $this->demo = $this->certificateRepository->getDemo($this->certificate);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'گواهینامه جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_certificates');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->certificate);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->certificateRepository->newCertificateObject());
            $this->reset(['name','title','logo','bg_image','autograph_image','border_image']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'name' => ['required','string','max:120'],
            'title' => ['required','string','max:250'],
            'logo' => ['nullable','string','max:250'],
            'bg_image' => ['nullable','string','max:250'],
            'autograph_image' => ['nullable','string','max:250'],
            'border_image' => ['nullable','string','max:250'],
        ], [] ,[
            'name'=> 'عنوان',
            'title'=> 'تیتر',
            'logo'=> 'لوگو',
            'bg_image'=> 'تصویر پسزمینه',
            'autograph_image'=> 'تصویر امضا',
            'border_image'=> 'تصویر قاب',
        ]);
        $model->name = $this->name;
        $model->title = $this->title;
        $model->logo = $this->logo;
        $model->bg_image = $this->bg_image;
        $model->autograph_image = $this->autograph_image;
        $model->border_image = $this->border_image;
        $model = $this->certificateRepository->save($model);
        if ($this->mode == self::CREATE_MODE)
            $this->userRepository->submit_certificate(Auth::user(),$model->id,0);

        return $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
    }

    public function render()
    {
        return view('admin.certificates.store-certificate')->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_certificates');
        $this->certificateRepository->delete($this->certificate);
        return redirect()->route('admin.certificate');
    }
}
