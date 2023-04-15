<?php

namespace App\Repositories\Classes;

use App\Models\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class GroupRepository implements GroupRepositoryInterface
{

    public function getAllAdmin($search, $course, $per_page = 10)
    {
        return Group::query()->latest()->when($course,function ($q) use ($course){
            return $q->whereHas('course',function ($q) use ($course){
                return $q->where('id',$course);
            });
        })->search($search)->paginate($per_page);
    }

    public function getAllOrgan($search, $course, $per_page = 10)
    {
        return Group::query()->latest()->whereHas('course',function ($q){
            return $q->whereIn('id',Auth::user()->organCourses->pluck('id'));
        })->when($course,function ($q) use ($course){
            return $q->whereHas('course',function ($q) use ($course){
                return $q->where('id',$course);
            });
        })->search($search)->paginate($per_page);
    }

    public function findOrFail($id)
    {
        return Group::query()->findOrFail($id);
    }

    public function organFindOrFail($id)
    {
        return Group::query()->whereHas('course',function ($q){
            return $q->whereIn('id',Auth::user()->organCourses->pluck('id'));
        })->findOrFail($id);
    }

    public function organUpdate($group_id , array $data)
    {
        Group::query()->whereHas('course',function ($q){
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->where('id',$group_id)->update($data);
    }

    public function create($data)
    {
        return Group::query()->create($data);
    }

    public function save(Group $group)
    {
        $group->save();
        return $group;
    }

    public function destroy($id)
    {
        Group::destroy($id);
    }

    public function find($id)
    {
        return Group::query()->find($id);
    }

    public static function getNewModel()
    {
        return new Group();
    }

    public function attachUser(Group $group, array $users)
    {
        $group->users()->attach($users);
    }

    public function syncUser(Group $group, array $users)
    {
        $group->users()->sync($users);
    }
}
