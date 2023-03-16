<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Http\Controllers\BaseComponent;

class Footer extends BaseComponent
{
    public  $title , $footerText , $address , $email , $autographs , $tel , $search , $copyRight , $users_can_send_teacher_request;

    public $links = [];

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->title = $settingRepository->getRow('title');
        $this->footerText = $settingRepository->getRow('footerText');
        $this->address = $settingRepository->getRow('address');
        $this->email = $settingRepository->getRow('email');
        $this->tel = $settingRepository->getRow('tel');
        $this->copyRight = $settingRepository->getRow('copyRight');
        $this->autographs = $settingRepository->getRow('autographs',[]);
        $this->links = $settingRepository->getRow('links',[]);
        $this->users_can_send_teacher_request = $settingRepository->getRow('users_can_send_teacher_request') ?? false;
    }

    public function render()
    {
        return view('site.includes.site.footer');
    }

    public function search()
    {
        if (!is_null($this->search)) {
            redirect()->route('articles',['q'=>$this->search]);
        }
    }
}
