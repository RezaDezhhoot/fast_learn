<?php 

namespace App\Repositories\Classes;

use App\Models\Executive;
use App\Observers\ExecutiveObserver;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;


class ExecutiveRepository implements ExecutiveRepositoryInterface
{
    public function destroy($id) 
    {
        Executive::destroy($id);
    }

    public function findOrFail($id , $parent = true)
    {
        return Executive::withCount(['users','courses'])->with(['child'])->parent($parent)->findOrFail($id);
    }

    public function getAllAdmin($search = null , $perPage = null) {
        return Executive::withCount(['users','courses','child'])->search($search)->parent()->paginate($perPage);
    }

    public function get(array $where = [] , $parent = false)
    {
        return Executive::withCount(['users','courses'])->with(['child'])->where($where)->parent($parent)->get();
    }

    public function newExecutiveObject() {
        return new Executive();
    }

    public function updateOrCreate(array $key , array $value) {
        return Executive::updateOrCreate($key , $value);
    }

    public function save(Executive $executive) {
        $executive->save();
        return $executive;
    }

    public static function observe() {
        return Executive::observe(ExecutiveObserver::class);
    }
}
