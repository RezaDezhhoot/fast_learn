<?php

namespace App\Repositories\Classes;

use App\Models\ViolationReport;
use App\Repositories\Interfaces\ViolationReportRepositoryInterface;

class ViolationReportRepository implements ViolationReportRepositoryInterface
{
    public function getAllAdmin($course, $status,$search, $perPage)
    {
        return ViolationReport::query()
            ->latest('id')
            ->when($course,function ($q) use ($course){
                return $q->whereHas('episode',function ($q) use ($course){
                    return $q->wherehas('chapter',function ($q) use ($course){
                        return $q->whereHas('course',function ($q) use ($course) {
                            return $q->where('id',$course);
                        });
                    });
                });
            })->when($status == '0' || $status == '1',function ($q) use ($status) {
                return $q->where('checked',$status);
            })->when($search,function ($q) use ($search) {
                return $q->whereHas('episode',function ($q) use ($search) {
                   return $q->where('title','like','%'.$search.'%');
                });
            })->paginate($perPage);
    }

    public function checked($id)
    {
        return ViolationReport::query()->where([
            ['id','=',$id],
            ['checked','=',false],
        ])->update([
            'checked' => true
        ]);
    }

    public function destroy($id)
    {
        return ViolationReport::destroy($id);
    }

    public static function getNew()
    {
        return ViolationReport::query()->where('checked',false)->count();
    }
}
