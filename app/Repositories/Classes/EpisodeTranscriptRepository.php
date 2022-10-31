<?php

namespace App\Repositories\Classes;

use App\Enums\EpisodeEnum;
use App\Models\EpisodeTranscript;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EpisodeTranscriptRepository implements EpisodeTranscriptRepositoryInterface
{

    public function save(EpisodeTranscript $episodeTranscript)
    {
        $episodeTranscript->save();
        return $episodeTranscript;
    }

    public function create(array $data)
    {
        return EpisodeTranscript::create($data);
    }

    public function destroy($id)
    {
        return EpisodeTranscript::destroy($id);
    }

    public static function getNewObject()
    {
        return new EpisodeTranscript();
    }

    public function getAllAdmin($search, $status, $course, $per_page)
    {
        return EpisodeTranscript::latest('id')->when($course,function ($q) use ($course) {
            return $q->whereHas('course',function ($q) use ($course) {
               return $q->where('id',$course);
            });
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function getAllTeacher($search, $status, $course, $per_page)
    {
        return EpisodeTranscript::latest('id')->whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->when($course,function ($q) use ($course) {
            return $q->whereHas('course',function ($q) use ($course) {
                return $q->where('id',$course);
            });
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function find($id)
    {
        return EpisodeTranscript::find($id);
    }

    public function findOrFail($id)
    {
        return EpisodeTranscript::findOrFail($id);
    }

    public function confirmThisTranscript(EpisodeTranscript $episodeTranscript , $episode)
    {
        $episode->title = $episodeTranscript->title;
        $episode->file = $episodeTranscript->file;
        $episode->link = $episodeTranscript->link;
        $episode->local_video = $episodeTranscript->local_video;
        $episode->allow_show_local_video = $episodeTranscript->allow_show_local_video;
        $episode->time = $episodeTranscript->time;
        $episode->view = $episodeTranscript->view;
        $episode->course_id  = $episodeTranscript->course_id;
        $episode->free  = $episodeTranscript->free;
        $episode->file_storage  = $episodeTranscript->file_storage;
        $episode->video_storage  = $episodeTranscript->video_storage;
        $episode->show_api_video  = $episodeTranscript->show_api_video;
        $episode->downloadable_local_video  = $episodeTranscript->downloadable_local_video;
        $episode->description  = $episodeTranscript->description;
        $episode->can_homework  = $episodeTranscript->can_homework;
        $episode->homework_storage  = $episodeTranscript->homework_storage;
        return $episode;
    }

    public function findTeacherEpisode($id)
    {
        return EpisodeTranscript::whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }

    public static function getNew()
    {
        return EpisodeTranscript::where('status',EpisodeEnum::PENDING_STATUS)->count();
    }
}
