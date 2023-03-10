<?php

namespace App\Repositories\Interfaces;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Model;

interface ChapterRepositoryInterface
{
    public function getAllAdmin($search , $course , $status, $pagination);

    public function getAllTeacher($search , $course , $status, $pagination);

    public function findOrFail($id);

    public function findOrFailTeacher($id);

    public function newModel(): Chapter;

    public function destroy($id);

    public function save(Chapter $chapter);

    public function alL($relation = null , $id = null , $foreign_ley = null);
}
