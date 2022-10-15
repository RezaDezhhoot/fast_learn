<?php


namespace App\Repositories\Interfaces;

use App\Models\Storage;

interface StorageRepositoryInterface
{
    public function getAllAdmin($search , $status  , $perPage);

    public static function observe();

    public function destroy($id);

    public function findOrFail($id);

    public function save(Storage $storage);

    public static function getNewObject();

    public function getAll();

    public function getFreeStorages();

    public function first(array $where = []);

}
