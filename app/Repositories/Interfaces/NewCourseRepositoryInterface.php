<?php

namespace App\Repositories\Interfaces;

use App\Models\NewCourse;

interface NewCourseRepositoryInterface
{
    public function getAllAdmin($search , $stratus , $per_page);

    public function getAllTeacher($search , $status , $per_page);

    public function find($id);

    public function findOrFail($id);

    public function destroy($id);

    public function save(NewCourse $newCourse);

    public static function getNew();

    public static function getNewTeacher();

    public function getNewObject();

    public function getTeachersCount();
}
