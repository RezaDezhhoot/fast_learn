<?php

namespace App\Observers;

use App\Enums\StorageEnum;
use App\Models\Storage;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StorageObserver
{

    private ?PermissionRepositoryInterface $permissionRepository;
    private ?RoleRepositoryInterface $roleRepository;

    public function __construct()
    {
        $this->permissionRepository = app(PermissionRepositoryInterface::class);
        $this->roleRepository = app(RoleRepositoryInterface::class);
    }

    /**
     * Handle the Storage "created" event.
     *
     * @param  \App\Models\Storage  $storage
     * @return void
     */
    public function created(Storage $storage)
    {
        $this->addPermissins($storage);
        if ($storage->driver == StorageEnum::PRIVATE) {
            mkdir(storage_path('app') . "/$storage->folder_name");
        }
    }

    /**
     * Handle the Storage "deleted" event.
     *
     * @param  \App\Models\Storage  $storage
     * @return void
     */
    public function deleted(Storage $storage)
    {
        try {
            $storage->update(['status' => StorageEnum::DELETED]);
            $this->deletePermissins($storage);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Handle the Storage "restored" event.
     *
     * @param  \App\Models\Storage  $storage
     * @return void
     */
    public function restored(Storage $storage)
    {
        $this->addPermissins($storage);
    }

    /**
     * Handle the Storage "force deleted" event.
     *
     * @param  \App\Models\Storage  $storage
     * @return void
     */
    public function forceDeleted(Storage $storage)
    {
        try {
            $this->deletePermissins($storage);
            self::deleteDir(storage_path('app') . "/$storage->folder_name");
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function addPermissins(Storage $storage)
    {
        $permissions = [
            ['name' => $storage->permission_name, 'guard_name' => 'web'],
        ];
        try {
            DB::beginTransaction();
            $this->permissionRepository->insert($permissions);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }

    private function deletePermissins(Storage $storage)
    {
        $this->permissionRepository->groupDelete([['name',$storage->permission_name]]);
    }

    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}
