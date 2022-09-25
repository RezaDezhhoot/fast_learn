<?php


namespace App\Repositories\Classes;

use App\Models\Permission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAll()
    {
        return Permission::all();
    }

    public function insert(array $data)
    {
        // TODO: Implement insert() method.
        return Permission::insert($data);
    }

    public function findOrFail($id , array $where = [])
    {
        return Permission::where($where)->findOrFail($id);
    }

    public function groupDelete(array $where = [])
    {
        return Permission::where($where)->delete();
    }
}
