<?php 

namespace App\Repositories\Classes;

use App\Models\Organization;
use App\Observers\OrganizationObserver;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;


class OrganizationRepository implements OrganizationRepositoryInterface
{
    public function destroy($id) 
    {
        Organization::destroy($id);
    }

    public function findOrFail($id , $parent = true)
    {
        return Organization::withCount(['users','courses'])->with(['child'])->parent($parent)->findOrFail($id);
    }

    public function getAllAdmin($search = null , $perPage = null) {
        return Organization::withCount(['users','courses','child'])->search($search)->parent()->paginate($perPage);
    }

    public function get(array $where = [] , $parent = false)
    {
        return Organization::withCount(['users','courses'])->with(['child'])->where($where)->parent($parent)->get();
    }

    public function newOrganizationObject() {
        return new Organization();
    }

    public function updateOrCreate(array $key , array $value) {
        return Organization::updateOrCreate($key , $value);
    }

    public function save(Organization $organization) {
        $organization->save();
        return $organization;
    }

    public static function observe() {
        return Organization::observe(OrganizationObserver::class);
    }

    public function find($id)
    {
        return Organization::find($id);
    }
}
