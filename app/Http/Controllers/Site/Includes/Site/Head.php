<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Livewire\Component;

class Head extends Component
{
    public function render(SettingRepositoryInterface $settingRepository)
    {
        $data = [
            'logo' => $settingRepository->getRow('logo'),
        ];
        return view('site.includes.site.head',$data);
    }
}
