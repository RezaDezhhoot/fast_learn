<?php


namespace App\Repositories\Interfaces;


use App\Models\Teacher;

interface TeacherRepositoryInterface
{
    public function getAllAdmin($search , $per_page);

    public function find($id);

    public function destroy($id);

    public function newTeacherObject();

    public function save(Teacher $teacher);

    public function getAll();

    public function count();

    public function updateOrCreate(array $key , array $value);

    public function delete($user_id);
}
