<?php

namespace App\Repositories\Interfaces;

use App\Models\IncomingMethod;

interface IncomingMethodRepositoryInterface
{
    public function getAllAdmin($search , $per_page);

    public function find($id);

    public function findOrFail($id);

    public function destroy($id);

    public function save(IncomingMethod $incomingMethod);

    public static function observe();

    public function getNewObject();

    public function getAll();

}
