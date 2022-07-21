<?php

namespace App\Repositories\Classes;
use App\Enums\ContactUsEnum;
use App\Models\ContactUs;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;

class ContactUsRepository implements ContactUsRepositoryInterface
{
    public function create(array $data)
    {
        return ContactUs::create($data);
    }

    public function destroy(int $id): int
    {
        return ContactUs::destroy($id);
    }

    public function get_new_items()
    {
        return ContactUs::where('status',ContactUsEnum::PENDING)->count();
    }

    public function getAllAdmin($search = null ,$status = null , $per_page = 10)
    {
        return ContactUs::latest('id')->when($status,function ($q) use ($status){
           return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function findOrFail($id)
    {
        return ContactUs::findOrFail($id);
    }

    public function find($id)
    {
        return ContactUs::find($id);
    }

    public function save(ContactUs $contactUs)
    {
        $contactUs->save();
        return $contactUs;
    }

    public function update(array $data, ContactUs $contactUs): bool
    {
        return $contactUs->update($data);
    }
}
