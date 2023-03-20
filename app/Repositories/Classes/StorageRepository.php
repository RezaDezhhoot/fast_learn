<?php


namespace App\Repositories\Classes;

use App\Enums\StorageEnum;
use App\Models\Storage;
use App\Observers\StorageObserver;
use App\Repositories\Interfaces\SettingRepositoryInterface;
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

    public function getConfig($storage)
    {
        $config = [];
        $defaultTypes = 'png,PNG';
        $defaultSize = 1024;
        if (!in_array($storage, array_keys(StorageEnum::getStorages()) )) {
            $storage = Storage::query()->find(explode(StorageEnum::RELATION_KEY_PREFIX,$storage)[1]);
            if (!is_null($storage->file_types))
                $config['allow_file_types'] = explode(',', $storage->file_types);
            else $config['allow_file_types'] = $defaultTypes;

            $config['max_file_size'] = !empty($storage->max_file_size) ? (int)$storage->max_file_size : $defaultSize;
        } else {
            $setting_repository = app(SettingRepositoryInterface::class);
            $max_file_size_db_public = $setting_repository->getRow('public_max_file_size');
            $max_file_size_db_private = $setting_repository->getRow('private_max_file_size');
            if ($storage == StorageEnum::PUBLIC) {
                if (!empty($setting_repository->getRow('public_storage_file_types')))
                    $config['allow_file_types'] = explode(',', $setting_repository->getRow('public_storage_file_types'));
                else $config['allow_file_types'] =  explode(',', $defaultTypes);
                $config['max_file_size'] = !empty($max_file_size_db_public) ? (int)$max_file_size_db_public : $defaultSize ;
            } else {
                if (!empty($setting_repository->getRow('private_storage_file_types')))
                    $config['allow_file_types'] = explode(',', $setting_repository->getRow('private_storage_file_types'));
                else $config['allow_file_types'] =  explode(',', $defaultTypes);
                $config['max_file_size'] = !empty($max_file_size_db_private) ? (int)$max_file_size_db_private : $defaultSize ;
            }
        }

        return $config;
    }
}
