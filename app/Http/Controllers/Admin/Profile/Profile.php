<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\WithFileUploads;

class Profile extends BaseComponent
{
    use WithFileUploads;

    public $user, $header, $role, $name , $email, $phone, $image, $password , $file;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->disk = getDisk(storage: StorageEnum::PUBLIC);
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->header = $this->user->name;
        $this->name = $this->user->name;
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;

        $this->data['province'] = $this->settingRepository::getProvince();
    }

    public function render()
    {
        if (isset($this->province) && in_array($this->province,array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);

        return view('admin.profile.profile',[
            'max_file_size' => !empty($this->settingRepository->getRow('max_profile_image_size')) ? $this->settingRepository->getRow('max_profile_image_size')  : 2048,
            'password_length' => !empty($this->settingRepository->getRow('password_length')) ? $this->settingRepository->getRow('password_length')  : 5,
        ])->extends('admin.layouts.admin');
    }

    public function store()
    {
        $fields = [
            'name' => ['required', 'string','max:150'],
            'phone' => ['required','size:11' , 'unique:users,phone,'. ($this->user->id ?? 0)],
            'email' => ['required','email','max:255' , 'unique:users,email,'. ($this->user->id ?? 0)],
            'file' => ['nullable','image','mimes:jpg,jpeg,png,PNG,JPG,JPEG','max:'.($this->settingRepository->getRow('max_profile_image_size') ?? 2048)],
        ];
        $messages = [
            'name' => 'نام ',
            'phone' => 'شماره همراه',
            'email' => 'ایمیل',
            'file' => 'تصویر پروفایل',
        ];
        if (isset($this->password) && !empty($this->password))
        {
            $fields['password'] = ['required','min:'.($this->settingRepository->getRow('password_length') ?? 5),'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'];
            $messages['password'] = 'گذرواژه';
        }
        $this->validate($fields,[],$messages);
        $this->uploadFile();
        if (!is_null($this->file)) {
            $oldFile = str_replace('storage','',$this->user->image);
            if (!is_null($this->user->image) && $this->disk->exists($oldFile))
                $this->disk->delete($oldFile);

            $this->user->image = 'storage/'.$this->disk->put('profiles',$this->file);
            unset($this->file);
        }

        $this->user->name = $this->name;
        $this->user->phone = $this->phone;
        $this->user->email = $this->email;
        if (isset($this->password))
            $this->user->password = $this->password;

        $this->userRepository->save($this->user);

        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function uploadFile()
    {
        // upon form submit, this function till fill your progress bar
    }

    public function updatedFile()
    {
        $this->resetErrorBag();
    }
}
