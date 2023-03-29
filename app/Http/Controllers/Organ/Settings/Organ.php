<?php

namespace App\Http\Controllers\Organ\Settings;

use App\Enums\OrganEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Organ extends BaseComponent
{
    use WithFileUploads;

    public $organ , $header ;

    public $image , $logo , $description ;

    public $info ,$address,  $email  , $phone1 , $phone2 , $province , $city , $web_site , $transcript , $transcript_status;

    public $new_logo , $new_image;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organRepository = app(OrganRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($id)
    {
        $this->organ = $this->organRepository->findMyOrgan($id);
        $this->header = $this->organ->title;
        $this->info = $this->organ->information;

        $this->image = $this->info->image ?? null;
        $this->logo = $this->info->logo ?? null;
        $this->description = $this->info->description ?? null;

        $this->email = $this->info->email ?? null;
        $this->address = $this->info->address ?? null;
        $this->phone1 = $this->info->phone1 ?? null;
        $this->phone2 = $this->info->phone2 ?? null;
        $this->province = $this->info->province ?? null;
        $this->city = $this->info->city ?? null;
        $this->web_site = $this->info->web_site ?? null;
        $this->transcript = $this->info->transcript ?? null;
        $this->transcript_status = $this->info->status ?? true;
        $this->data['province'] = $this->settingRepository::getProvince();

    }

    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && !empty($this->province)){
            $this->data['city'] = $this->settingRepository->getCity($this->province);
        }
        return view('organ.settings.organ')->extends('organ.layouts.organ');
    }

    public function resetFile()
    {
        $this->reset(['new_logo','new_image']);
    }

    public function store()
    {
        if ($rateKey = rateLimiter(value:auth()->id().'_organ',max_tries: 3))
        {
            $this->resetFile();
            return
                $this->addError('address', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
        }

        $this->validate([
            'new_logo' => [ empty($this->logo) ? 'required' : 'nullable' ,'file','max:2048','mimes:jpg,jpeg,png'],
            'new_image' => [empty($this->image) ? 'required' : 'nullable','file','max:2048','mimes:jpg,jpeg,png'],
            'description' => ['nullable','string','max:7500000'],
            'address' => ['nullable','string','max:250'],
            'email' => ['nullable','email','max:250'],
            'phone1' => ['nullable','numeric'],
            'phone2' => ['nullable','numeric'],
            'province' => ['nullable','string',Rule::in(array_keys($this->data['province']))],
            'city' => ['nullable','string',Rule::in(array_keys($this->data['city']))],
            'web_site' => ['nullable','string','max:250'],
        ],[],[
            'image' => 'ایکون',
            'description' => 'توضیحات',
            'logo' => 'لوگو',
            'address' => 'ادرس',
            'email' => 'ایمیل',
            'phone1' => 'شماره1',
            'phone2' => 'شماره2',
            'province' => 'استان',
            'city' => 'شهر',
            'web_site' => 'ادرس سایت',
        ]);

        if (isset($this->new_logo) && !empty($this->new_logo)) {
            $this->logo = 'storage/' . getDisk(StorageEnum::PUBLIC)->put('organs', $this->new_logo);
        }

        if (isset($this->new_image) && !empty($this->new_image)) {
            $this->image = 'storage/' . getDisk(StorageEnum::PUBLIC)->put('organs', $this->new_image);
        }

        $transcript['address'] = $this->address;
        $transcript['image'] = $this->image;
        $transcript['logo'] = $this->logo;
        $transcript['description'] = $this->description;
        $transcript['email'] = $this->email;
        $transcript['phone1'] = $this->phone1;
        $transcript['phone2'] = $this->phone2;
        $transcript['province'] = $this->province;
        $transcript['city'] = $this->city;
        $transcript['web_site'] = $this->web_site;
        $data['transcript'] = $transcript;
        $data['status'] = false;
        $this->organRepository->setInfo($this->organ,$data);
        $this->resetFile();
        $this->emitNotify('اطلاعات با موفقیت ذحیره  و در صف بررسی قرار گرفت');
    }
}
