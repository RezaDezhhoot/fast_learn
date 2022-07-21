<?php

namespace App\Repositories\Interfaces;

interface LogRepositoryInterface
{
    public function getAllAdmin($user,$subject,$per_page);

    public function find($id);
}
