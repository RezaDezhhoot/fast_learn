<?php

namespace App\Http\Controllers\Admin\Organs;

use App\Enums\OrganEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\User;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreOrgan extends BaseComponent
{
    public $organ , $header , $user;

    public $title , $slug  , $image , $logo , $percent, $description , $status , $seo_keywords , $seo_description , $user_id;

    public $info ,$address,  $email  , $phone1 , $phone2 , $province , $city , $web_site , $transcript , $transcript_status;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organRepository = app(OrganRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('edit_organs');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->organ = $this->organRepository->findOrFail($id);
            $this->title = $this->organ->title;
            $this->percent = $this->organ->percent;
            $this->slug = $this->organ->slug;
            $this->status = $this->organ->status;
            $this->user_id = $this->organ->user_id;
            $this->seo_keywords = $this->organ->seo_key_words;
            $this->seo_description = $this->organ->seo_description;
            $this->header = $this->title;
            $this->user = $this->userRepository->find($this->organ->user_id)->phone;
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
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'ارگان جدید';
        } else abort(404);
        $this->data['status'] = OrganEnum::getStatus();
        $this->data['province'] = $this->settingRepository::getProvince();

        $this->data['users'] = [];
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->organ);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->organRepository->getNewModel());
            $this->reset(['slug','title','image','logo','seo_keywords','percent','seo_description','status','description','user_id','address','email','phone1','phone2','province','city','web_site']);
        }
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'title' => ['required','string','max:70'],
            'image' => ['required','string','max:250'],
            'logo' => ['required','string','max:250'],
            'description' => ['nullable','string','max:7500000'],
            'status' => ['required',Rule::in(array_keys(OrganEnum::getStatus()))],
            'seo_keywords' => ['required','string','max:500'],
            'seo_description' => ['required','string','max:1000'],
            'user' => ['required','exists:users,id'],
            'percent' => ['nullable','between:0,100'],

            'address' => ['nullable','string','max:250'],
            'email' => ['nullable','email','max:250'],
            'phone1' => ['nullable','numeric'],
            'phone2' => ['nullable','numeric'],
            'province' => ['nullable','string',Rule::in(array_keys($this->data['province']))],
            'city' => ['nullable','string',Rule::in(array_keys($this->data['city']))],
            'web_site' => ['nullable','string','max:250'],
        ],[],[
            'title' => 'عنوان',
            'image' => 'ایکون',
            'description' => 'توضیحات',
            'logo' => 'لوگو',
            'status' => 'وضعیت',
            'seo_keywords' => 'کلمات کلیدی',
            'seo_description' => 'توضیحات سئو',
            'user' => 'شماره کاربر',

            'address' => 'ادرس',
            'email' => 'ایمیل',
            'phone1' => 'شماره1',
            'phone2' => 'شماره2',
            'province' => 'استان',
            'city' => 'شهر',
            'web_site' => 'ادرس سایت',
        ]);
        $model->title = $this->title;
        $model->status = $this->status;
        $model->percent = $this->percent;
        $model->seo_key_words = $this->seo_keywords;
        $model->user_id = $this->user;
        $model->seo_description = $this->seo_description;

        try {
            DB::beginTransaction();
            $model = $this->organRepository->save($model);
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
            $transcript['transcript'] = $this->transcript ?? $transcript;
            $transcript['status'] = $this->transcript_status ?? true;
            $this->organRepository->setInfo($model,$transcript);
            DB::commit();
            $this->emitNotify('اطلاعات با موفقیت ذحیره شد');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emitNotify($e->getMessage());
        }
    }

    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && !empty($this->province)){
            $this->data['city'] = $this->settingRepository->getCity($this->province);
        }

        $this->data['city2'] = [];
        if (isset($this->transcript['province']) && !empty($this->transcript['province'])){
            $this->data['city2'] = $this->settingRepository->getCity($this->transcript['province']);
        }

        return view('admin.organs.store-organ')->extends('admin.layouts.admin');
    }

    public function confirmTranscript()
    {
        $this->address = $this->transcript['logo'] ?? $this->logo;
        $this->email = $this->transcript['image'] ?? $this->image;
        $this->phone1 = $this->transcript['description'] ?? $this->description;
        $this->address = $this->transcript['address'] ?? $this->address;
        $this->email = $this->transcript['email'] ?? $this->email;
        $this->phone1 = $this->transcript['phone1'] ?? $this->phone1;
        $this->phone2 = $this->transcript['phone2'] ?? $this->phone2;
        $this->province = $this->transcript['province'] ?? $this->province;
        $this->city = $this->transcript['city']  ?? $this->city;
        $this->web_site = $this->transcript['web_site'] ?? $this->web_site;
        $this->transcript_status = true;
    }

    public function deleteItem()
    {
        $this->authorizing('delete_organs');
        $this->organRepository->destroy($this->organ->id);
        redirect()->route('admin.organ');
    }

    public function searchUser()
    {
        $this->data['users'] = User::query()
            ->select([DB::raw("CONCAT(`users`.`name`,'-',`users`.`phone`,'-',`users`.`email`) as title"),'id'])
            ->search($this->user)
            ->take(10)
            ->get()->pluck('title','id')->toArray();
    }
}
