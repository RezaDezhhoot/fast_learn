<?php

namespace App\Repositories\Classes;

use App\Models\LastActivity;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LastActivityRepository implements LastActivityRepositoryInterface
{

    public function register_activity(array $data)
    {
        return LastActivity::create($data);
    }
}
