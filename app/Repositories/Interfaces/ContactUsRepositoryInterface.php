<?php

namespace App\Repositories\Interfaces;

use App\Models\ContactUs;

interface ContactUsRepositoryInterface
{
    public function create(array $data);

    public function destroy(int $id): int;

    public function get_new_items();

    public function getAllAdmin($search = null ,$status = null , $per_page = 10);

    public function findOrFail($id);

    public function find($id);

    public function save(ContactUs $contactUs);

    public function update(array $data , ContactUs $contactUs);
}
