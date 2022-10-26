<?php

namespace App\Repositories\Interfaces;

interface NewCourseChatRepositoryInterface
{
    public function create(array $data);

    public function destroy($id);
}
