<?php


namespace App\Repositories\Interfaces;


interface ReductionMetaRepositoryInterface
{
    public function updateOrCreate(array $key , array $value);

    public function delete(array $conditions);
}
