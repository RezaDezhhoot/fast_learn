<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Http\Controllers\BaseComponent;

class Footer extends BaseComponent
{
    public $logo , $title , $footerText , $address , $email , $autographs , $tel , $search , $copyRight;



    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->logo = $settingRepository->getRow('logo');
        $this->title = $settingRepository->getRow('title');
        $this->footerText = $settingRepository->getRow('footerText');
        $this->address = $settingRepository->getRow('address');
        $this->email = $settingRepository->getRow('email');
        $this->tel = $settingRepository->getRow('tel');
        $this->copyRight = $settingRepository->getRow('copyRight');
        $this->autographs = $settingRepository->getRow('autographs',[]);
    }

    public function render()
    {
        return view('site.includes.site.footer');
    }

    public function search()
    {
        return redirect()->route('articles',['q' => $this->search]);
    }
}
