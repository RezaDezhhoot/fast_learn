<?php


namespace App\Repositories\Classes;


use App\Models\Episode;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;

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
        return Episode::findOrFail($id);
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
}
