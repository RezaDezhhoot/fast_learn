<?php


namespace App\Repositories\Interfaces;


use App\Models\Reduction;

interface ReductionRepositoryInterface
{
    public function getAllAdmin($search , $per_page);

    public function destroy($id);

    public function find($id);

    public function save(Reduction $reduction);

    public function newReductionObject();

    public function get(array $where);
}
