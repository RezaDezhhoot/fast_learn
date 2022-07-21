<?php

namespace App\Repositories\Classes;

use App\Models\Activity;
use App\Repositories\Interfaces\LogRepositoryInterface;

class LogRepository implements LogRepositoryInterface
{

    public function getAllAdmin($user , $subject, $per_page)
    {
        return Activity::with(['causer','subject'])->latest('id')->when($user,function ($q) use ($user){
           return $q->whereHas('causer',function ($q) use ($user){
               return $q->where('id',$user)->orWhere('phone',$user);
           });
        })->when($subject,function ($q) use ($subject){
            return $q->where('subject_type',$subject);
        })->paginate($per_page);
    }

    public function find($id)
    {
        return Activity::find($id);
    }
}
