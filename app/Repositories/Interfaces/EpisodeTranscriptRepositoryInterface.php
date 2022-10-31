<?php

namespace App\Repositories\Interfaces;

use App\Models\EpisodeTranscript;

interface EpisodeTranscriptRepositoryInterface
{
    public function save(EpisodeTranscript $episodeTranscript);

    public function create(array $data);

    public function destroy($id);

    public static function getNewObject();

    public function getAllAdmin($search , $status , $course , $per_page);

    public function getAllTeacher($search , $status , $course , $per_page);

    public function find($id);

    public function findOrFail($id);

    public function confirmThisTranscript(EpisodeTranscript $episodeTranscript , $episode);

    public function findTeacherEpisode($id);

    public static function getNew();
}
