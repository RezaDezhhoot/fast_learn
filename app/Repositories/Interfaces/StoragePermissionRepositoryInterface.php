<?php

namespace App\Repositories\Interfaces;

use App\Models\StoragePermission;

interface StoragePermissionRepositoryInterface
{
    public function getAllAdmin($search , $storage , $per_page);

    public function destroy($id);

    public function save(StoragePermission $storagePermission);

    public static function getNewObject();

    public function findOrFail($id);

    public function find($id);

    public function update($id , array $data);
}
