<?php


namespace App\Repositories\Interfaces;


interface UserDetailRepositoryInterface
{
    public function updateOrCreate(array $key , array $value);
}
