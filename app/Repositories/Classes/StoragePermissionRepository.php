<?php

namespace App\Repositories\Classes;

use App\Models\StoragePermission;
use App\Repositories\Interfaces\StoragePermissionRepositoryInterface;

class StoragePermissionRepository implements StoragePermissionRepositoryInterface
{

    public function getAllAdmin($search, $storage, $per_page)
    {
        return StoragePermission::latest('id')->when($search,function ($q) use ($search){
            return $q->whereHas('user',function ($q) use ($search){
                return $q->where('phone',$search)->orWhere('name',$search);
            });
        })->when($storage,function ($q) use ($storage) {
            return $q->whereHas('storage',function ($q) use ($storage) {
               return $q->where('id',$storage);
            });
        })->paginate($per_page);
    }

    public function destroy($id)
    {
        return StoragePermission::destroy($id);
    }

    public function save(StoragePermission $storagePermission)
    {
        $storagePermission->save();
        return $storagePermission;
    }

    public static function getNewObject()
    {
        return new StoragePermission();
    }

    public function findOrFail($id)
    {
        return StoragePermission::findOrFail($id);
    }

    public function find($id)
    {
        return StoragePermission::find($id);
    }

    public function update($id,array $data)
    {
        return StoragePermission::where('id',$id)->update($data);
    }
}
