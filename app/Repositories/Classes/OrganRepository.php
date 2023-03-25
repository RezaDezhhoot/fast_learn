<?php

namespace App\Repositories\Classes;

use App\Models\Organ;
use App\Repositories\Interfaces\OrganRepositoryInterface;

class OrganRepository implements OrganRepositoryInterface
{
    public function getAllAdmin($status, $user, $search,$new_info, $per_page)
    {
        return Organ::query()->when($status,function ($q) use ($status) {
           return $q->where('status',$status);
        })->when($user,function ($q) use ($user){
            return $q->wherehas('user',function ($q) use ($user) {
                return $q->search($user);
            });
        })->when($new_info == '0' || $new_info == '1',function ($q) use ($new_info) {
            return $q->whereHas('information',function ($q) use ($new_info){
                $q->where('status',$new_info);
            });
        })->search($search)->paginate($per_page);
    }

    public function findOrFail($id, $published = false)
    {
        return Organ::published($published)->findOrFail($id);
    }

    public function destroy($id)
    {
        return Organ::destroy($id);
    }

    public function save(Organ $organ)
    {
        $organ->save();
        return $organ;
    }

    public function create(array $data)
    {
        return Organ::create($data);
    }

    public function update(array $data, Organ $organ)
    {
        $organ->update($data);
        return $organ;
    }

    public function getNewModel()
    {
        return new Organ();
    }

    public function setInfo(Organ $organ, array $data)
    {
        return $organ->information()->updateOrCreate([
            'organ_id' => $organ->id
        ],$data);
    }

    public function getNew()
    {
        return Organ::query()->whereHas('information',function ($q){
            return $q->where('status',0);
        })->count();
    }

    public function getAll()
    {
        return Organ::all();
    }

    public function count()
    {
        return Organ::count();
    }

    public function findBYSlug($slug)
    {
        return Organ::query()->published(true)->where('slug',$slug)->firstOrFail();
    }
}
