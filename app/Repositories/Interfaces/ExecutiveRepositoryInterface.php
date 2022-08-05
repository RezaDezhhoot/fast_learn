<?php

namespace App\Repositories\Interfaces;

use App\Models\Executive;

interface ExecutiveRepositoryInterface
{
    public function destroy($id);

    public function findOrFail($id , $parent = true);

    public function getAllAdmin($search = null , $perPage = null);

    public function get(array $where = [] , $parent = false);

    public function newExecutiveObject();

    public function updateOrCreate(array $key , array $value);

    public function save(Executive $executive);

    public static function observe();
}