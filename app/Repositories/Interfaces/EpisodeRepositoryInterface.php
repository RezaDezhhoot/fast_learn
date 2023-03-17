<?php


namespace App\Repositories\Interfaces;


use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;

interface EpisodeRepositoryInterface
{
    public function destroy($id);

    public function find($id);

    public function findOrFail($id);

    public function save(Episode $episode);

    public function newEpisodeObject();

    public function findMany(array $ids);

    public function getAllAdmin($course = null , $chapter = null ,$search = null,$perPage = 10);

    public function getAllTeacher($course , $search , $per_page);

    public function findTeacherEpisode($id);

    public function getTeachersCount($from_date , $to_date);

    public function newComment(Episode $episode, array $data);

    public function hasLiked($episode);

    public function like($episode);

    public function unLike($episode);

    public function submitReport(Episode $episode , $subject);

    public function hasReported(Episode $episode);
}
