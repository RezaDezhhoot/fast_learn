<?php


namespace App\Repositories\Classes;

use App\Models\ReductionMeta;
use App\Repositories\Interfaces\ReductionMetaRepositoryInterface;

class ReductionMetaRepository implements ReductionMetaRepositoryInterface
{

    public function updateOrCreate(array $key, array $value)
    {
        ReductionMeta::updateOrCreate($key, $value);
    }

    public function delete(array $conditions)
    {
        ReductionMeta::where($conditions)->delete();
    }
}
