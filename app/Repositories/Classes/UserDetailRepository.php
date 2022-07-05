<?php


namespace App\Repositories\Classes;

use App\Models\UserDetail;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;

class UserDetailRepository implements UserDetailRepositoryInterface
{
    public function updateOrCreate(array $key, array $value)
    {
        UserDetail::updateOrCreate($key,$value);
    }
}
