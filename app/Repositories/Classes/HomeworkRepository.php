<?php


namespace App\Repositories\Classes;


use App\Models\Homework;
use App\Observers\HomeworkObserver;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use Illuminate\Support\LazyCollection;

class HomeworkRepository implements HomeworkRepositoryInterface
{
    public function get(array $where = [] , $action = 'first')
    {
        return $action == 'first' ? Homework::where($where)->first() : Homework::with(['episode','episode.course'])->where($where)->cursor();
    }

    public function updateOrCreate(array $key, array $value)
    {
        return Homework::updateOrCreate($key,$value);
    }

    public function destroy($id)
    {
        Homework::destroy($id);
    }

    public function getAllAdmin(array $where ,$per_page)
    {
        return Homework::where($where)->paginate($per_page);
    }

    public function save(Homework $homework)
    {
        $homework->save();
        return $homework;
    }

    public static function observe()
    {
        Homework::observe(HomeworkObserver::class);
    }
}
