<?php

namespace App\Repositories\Interfaces;
use Illuminate\Database\Eloquent\Collection;

interface LastActivityRepositoryInterface
{
    public function register_activity(array $data);
}
