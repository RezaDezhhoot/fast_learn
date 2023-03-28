<?php

namespace App\Repositories\Interfaces;

use App\Models\Group;

interface GroupRepositoryInterface
{
    public function getAllAdmin($search , $course , $per_page = 10);

    public function getAllOrgan($search, $course, $per_page = 10);

    public function findOrFail($id);

    public function organFindOrFail($id);

    public function create($data);

    public function save(Group $group);

    public function destroy($id);

    public function find($id);

    public static function getNewModel();

    public function syncUser(Group $group , array $users);

    public function attachUser(Group $group , array $users);
}
