<?php

namespace App\Http\Controllers\Teacher\Layouts;

use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\Component;

class Sidebar extends Component
{
    public function render
    (
        CommentRepositoryInterface $commentRepository,
        NewCourseRepositoryInterface $newCourseRepository
    )
    {
        $data = [
            'comments' => $commentRepository::getNew(),
            'new_courses' => $newCourseRepository::getNewTeacher(),
        ];
        return view('teacher.layouts.sidebar',$data);
    }
}
