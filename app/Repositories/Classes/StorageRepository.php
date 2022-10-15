<?php


namespace App\Repositories\Classes;

use App\Models\Storage;
use App\Observers\StorageObserver;
use App\Repositories\Interfaces\StorageRepositoryInterface;

class StorageRepository implements StorageRepositoryInterface
{

    public function getAllAdmin($search , $status, $perPage)
    {
        return Storage::withoutGlobalScope('available')->latest('id')->withTrashed()->when($status,function($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($perPage);
    }

    public static function observe()
    {
        return Storage::observe(StorageObserver::class);
    }

    public function destroy($id)
    {
        $item = $this->findOrFail($id);
        if ($item->trashed()) {
            return $item->forceDelete();
        } else {
            return $item->delete();
        }
    }

    public function findOrFail($id)
    {
        return Storage::withoutGlobalScope('available')->withTrashed()->findOrFail($id);
    }

    public function first(array $where = [])
    {
        return Storage::where($where)->first();
    }

    public function save(Storage $storage)
    {
        $storage->save();
        return $storage;
    }

    public static function getNewObject()
    {
        return new Storage();
    }

    public function getAll()
    {
        return Storage::all();
    }

    public function getFreeStorages()
    {
        return Storage::doesntHave('acl')->get();
    }
}
