<?php

namespace App\Repositories\Classes;

use App\Enums\CourseEnum;
use App\Models\NewCourse;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class NewCourseRepository implements NewCourseRepositoryInterface
{

    public function getAllAdmin($search, $stratus, $per_page)
    {
        return NewCourse::latest('id')->with('user')->when($stratus , function ($q) use ($stratus){
           return $q->where('status',$stratus);
        })->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return NewCourse::with('user')->find($id);
    }

    public function findOrFail($id)
    {
        if (\auth()->user()->hasRole('admin'))
            return NewCourse::with('user')->findOrFail($id);
        else {
            return NewCourse::with('user')->whereHas('user',function ($q){
                return $q->where('id',\auth()->id());
            })->orWhereHas('organ',function ($q){
                return $q->whereIn('id',Auth::user()->organs->pluck('id'));
            })->findOrFail($id);
        }
    }

    public function destroy($id)
    {
        return NewCourse::destroy($id);
    }

    public function save(NewCourse $newCourse)
    {
        $newCourse->save();
        return $newCourse;
    }

    public static function getNew()
    {
        return NewCourse::where('status',CourseEnum::NEW_COURSE_PENDING)->orWhere('status',CourseEnum::NEW_COURSE_TEACHER_ANSWERED)->count();
    }

    public static function getNewTeacher()
    {
        return NewCourse::where('status',CourseEnum::NEW_COURSE_ANSWERED)->whereHas('user',function ($q){
            return $q->where('id',Auth::id());
        })->count();

    }

    public function getAllTeacher($search, $status, $per_page)
    {
        return NewCourse::latest('id')->whereHas('user',function ($q){
           return $q->where('id',Auth::id());
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function getAllOrgan($search, $status, $per_page)
    {
        return NewCourse::latest('id')->whereHas('organ',function ($q){
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function getNewObject()
    {
        return new NewCourse();
    }

    public function getTeachersCount()
    {
        return NewCourse::where('status',CourseEnum::NEW_COURSE_PENDING)->where('user_id',Auth::id())->count();
    }

    public function getOrgansCount()
    {
        return NewCourse::where('status',CourseEnum::NEW_COURSE_PENDING)->whereHas('organ',function ($q) {
            return $q->whereIn('id',Auth::user()->organs->pluck('id'));
        })->count();
    }
}
