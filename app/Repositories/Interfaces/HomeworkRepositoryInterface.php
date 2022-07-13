<?php


namespace App\Repositories\Interfaces;


use App\Models\Homework;
use Illuminate\Support\LazyCollection;

interface HomeworkRepositoryInterface
{
    public function get(array $where = [] , $action = 'first');

    public function updateOrCreate(array $key , array $value);

    public function destroy($id);

    public function getAllAdmin(array $where ,$per_page);

    public function save(Homework $homework);

    public static function observe();
}
