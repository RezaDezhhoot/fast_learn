<?php

namespace App\Repositories\Classes;

use App\Enums\TeacherEnum;
use App\Models\TeacherRequest;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;

class TeacherRequestRepository implements TeacherRequestRepositoryInterface
{

    public function newApply(array $data)
    {
        return TeacherRequest::create($data);
    }

    public static function getNew()
    {
        return TeacherRequest::where('status',TeacherEnum::APPLY_PENDING)->count();
    }

    public function getAllAdmin($search, $status, $per_page)
    {
        return TeacherRequest::latest('id')->with('user')->when($search , function ($q) use ($search){
            return $q->whereHas('user',function ($q) use ($search){
                return $q->where('phone','LIKE','%'.$search.'%');
            });
        })->when($status,function ($q) use ($status){
            return $q->where('status',$status);
        })->paginate($per_page);
    }

    public function destroy($id): int
    {
        return TeacherRequest::destroy($id);
    }

    public function findOrFail($id)
    {
        return TeacherRequest::findOrFail($id);
    }

    public function save(TeacherRequest $teacherRequest): TeacherRequest
    {
        $teacherRequest->save();
        return $teacherRequest;
    }
}
