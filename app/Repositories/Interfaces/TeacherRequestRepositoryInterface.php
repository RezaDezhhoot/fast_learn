<?php

namespace App\Repositories\Interfaces;

use App\Models\TeacherRequest;

interface TeacherRequestRepositoryInterface
{
    public function newApply(array $data);

    public static function getNew();

    public function getAllAdmin($search , $status , $per_page);

    public function destroy($id);

    public function findOrFail($id);

    public function save(TeacherRequest $teacherRequest): TeacherRequest;
}
