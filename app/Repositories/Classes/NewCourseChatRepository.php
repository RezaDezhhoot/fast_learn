<?php

namespace App\Repositories\Classes;

use App\Models\NewCourseChat;
use App\Repositories\Interfaces\NewCourseChatRepositoryInterface;

class NewCourseChatRepository implements NewCourseChatRepositoryInterface
{

    public function create(array $data)
    {
        return NewCourseChat::create($data);
    }

    public function destroy($id)
    {
        return NewCourseChat::destroy($id);
    }
}
