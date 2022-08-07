<?php

namespace App\Repositories\Interfaces;

use App\Models\Organization;


interface OrganizationRepositoryInterface
{
    public function destroy($id);

    public function findOrFail($id , $parent = true);

    public function getAllAdmin($search = null , $perPage = null);

    public function get(array $where = [] , $parent = false);

    public function newOrganizationObject();

    public function updateOrCreate(array $key , array $value);

    public function save(Organization $organization);

    public static function observe();

    public function find($id);
}