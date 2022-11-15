<?php


namespace App\Repositories\Classes;

use App\Models\Teacher;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllAdmin($search, $per_page , $panel_status = false)
    {
        return Teacher::with('user')->when($panel_status,function ($q){
            return $q->where('panel_status',true);
        })->when($search,function ($q) use ($search){
            return $q->whereHas('user',function ($q) use ($search){
                return is_numeric($search) ? $q->where('phone',$search) : $q->where('name',$search);
            });
        })->paginate($per_page);
    }

    public function find($id)
    {
        return Teacher::findOrFail($id);
    }

    public function destroy($id)
    {
        return Teacher::destroy($id);
    }

    public function newTeacherObject()
    {
        return new Teacher();
    }

    public function save(Teacher $teacher)
    {
        $teacher->save();
        return $teacher;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Teacher::all();
    }

    public function count()
    {
        return Teacher::count();
    }

    public function updateOrCreate(array $key, array $value)
    {
        Teacher::withTrashed()->updateOrCreate($key,$value);
    }

    public function delete($user_id)
    {
        $teacher = Teacher::where('user_id',$user_id)->first();
        if (!is_null($teacher))
            $teacher->delete();
    }
}
