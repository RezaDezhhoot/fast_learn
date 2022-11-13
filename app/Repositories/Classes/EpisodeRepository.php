<?php


namespace App\Repositories\Classes;


use App\Models\Episode;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EpisodeRepository implements EpisodeRepositoryInterface
{
    public function destroy($id)
    {
       return Episode::destroy($id);
    }

    public function find($id)
    {
        return Episode::find($id);
    }

    public function findOrFail($id)
    {
        return Episode::with('homeworks')->findOrFail($id);
    }

    public function save(Episode $episode)
    {
        $episode->save();
        return $episode;
    }

    public function newEpisodeObject()
    {
        return new Episode();
    }

    public function findMany(array $ids)
    {
        return Episode::findMany($ids);
    }

    public function getAllAdmin($course = null, $search = null, $perPage = 10)
    {
        return Episode::latest('id')->with('course')->when($course,function ($q) use ($course){
           return $q->wherehas('course',function ($q) use ($course){
               return $q->where('id',$course);
           });
        })->search($search)->paginate($perPage);
    }

    public function getAllTeacher($course, $search, $per_page)
    {
        return Episode::latest('id')->whereHas('course',function ($q) {
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->when($course,function ($q) use ($course){
            return $q->whereHas('course',function ($q) use ($course) {
                return $q->where('id',$course);
            });
        })->search($search)->paginate($per_page);
    }

    public function findTeacherEpisode($id)
    {
        return Episode::whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }

    public function getTeachersCount($from_date , $to_date)
    {
        return Episode::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->whereHas('course',function ($q){
           return $q->whereHas('teacher',function ($q){
              return $q->where('user_id',Auth::id());
           });
        })->count();
    }
}
