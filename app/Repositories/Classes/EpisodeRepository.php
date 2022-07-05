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
}
