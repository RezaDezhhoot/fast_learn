<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class CodeController extends Controller
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function __invoke($code): RedirectResponse
    {
        $id = base64_decode($code);
        $course = $this->courseRepository->find($id);
        return redirect()->route('course',$course->slug);
    }
}
