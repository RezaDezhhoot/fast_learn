<?php


namespace App\Repositories\Classes;

use App\Models\Reduction;
use App\Repositories\Interfaces\ReductionRepositoryInterface;

class ReductionRepository implements ReductionRepositoryInterface
{
    public function getAllAdmin($search, $per_page)
    {
        return Reduction::latest('id')->search($search)->paginate($per_page);
    }

    public function destroy($id)
    {
        return Reduction::destroy($id);
    }

    public function find($id)
    {
        return Reduction::findOrFail($id);
    }

    public function save(Reduction $reduction)
    {
        $reduction->save();
        return $reduction;
    }

    public function newReductionObject()
    {
        return new Reduction();
    }

    public function get(array $where)
    {
        return Reduction::where($where)->first();
    }
}
