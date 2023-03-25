<?php

namespace App\Repositories\Interfaces;

use App\Models\Organ;

interface OrganRepositoryInterface
{
    public function getAllAdmin($status , $user , $search,$new_info , $per_page);

    public function findOrFail($id , $published = false);

    public function destroy($id);

    public function save(Organ $organ);

    public function create(array $data);

    public function update(array $data , Organ $organ);

    public function getNewModel();

    public function setInfo(Organ $organ , array $data);

    public function getNew();

    public function getAll();

    public function count();

    public function findBYSlug($slug);

    public function getMyOrgans($search , $per_page);

    public function findMyOrgan($id);
}
