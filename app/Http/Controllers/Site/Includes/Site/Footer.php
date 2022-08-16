<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Http\Controllers\BaseComponent;

class Footer extends BaseComponent
{
    public  $title , $footerText , $address , $email , $autographs , $tel , $search , $copyRight ;

    public function mount(SettingRepositoryInterface $settingRepository)
    {
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
        if (!is_null($this->search)) {
            redirect()->route('articles',['q'=>$this->search]);
        }
    }
}
