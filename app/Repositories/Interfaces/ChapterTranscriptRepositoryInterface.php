<?php

namespace App\Repositories\Interfaces;

use App\Models\ChapterTranscript;

interface ChapterTranscriptRepositoryInterface
{
    public function getAllAdmin($course , $status , $search , $perPage);

    public function getAllTeacher($course , $status , $search , $perPage);

    public function findOrFailTeacher($id);

    public function findOrFail($id);

    public function destroy($id);

    public function save(ChapterTranscript $chapterTranscript);

    public function create(array $data);

    public static function getNewObject();

    public function confirmThisTranscript(ChapterTranscript $chapterTranscript  , $status ,$chapter = null);

    public function findTeacherChapter($id);

    public static function getNew();
}
