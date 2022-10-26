<?php

namespace App\Repositories\Classes;

use App\Models\IncomingMethod;
use App\Observers\IncomingMethodObserver;
use App\Repositories\Interfaces\IncomingMethodRepositoryInterface;

class IncomingMethodRepository implements IncomingMethodRepositoryInterface
{

    public function getAllAdmin($search, $per_page)
    {
        return IncomingMethod::latest('id')->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return IncomingMethod::find($id);
    }

    public function findOrFail($id)
    {
        return IncomingMethod::findOrFail($id);
    }

    public function destroy($id)
    {
        return IncomingMethod::destroy($id);
    }

    public function save(IncomingMethod $incomingMethod)
    {
        $incomingMethod->save();
        return $incomingMethod;
    }

    public static function observe()
    {
        IncomingMethod::observe(IncomingMethodObserver::class);
    }

    public function getNewObject()
    {
        return new IncomingMethod();
    }

    public function getAll()
    {
        return IncomingMethod::all();
    }
}
