<?php

namespace App\Repositories\Classes;

use App\Enums\ChapterEnum;
use App\Models\ChapterTranscript;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ChapterTranscriptRepository implements ChapterTranscriptRepositoryInterface
{

    public function getAllAdmin($course, $status, $search, $perPage)
    {
        return ChapterTranscript::latest('id')->with('chapter',function ($q){
            return $q->withoutGlobalScopes();
        })->when($course,function ($q) use ($course) {
            return $q->whereHas('course',function ($q) use ($course) {
                return $q->where('id',$course);
            });
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($perPage);
    }

    public function getAllTeacher($course, $status, $search, $perPage)
    {
        return ChapterTranscript::latest('id')->whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->when($course,function ($q) use ($course) {
            return $q->whereHas('course',function ($q) use ($course) {
                return $q->where('id',$course);
            });
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($perPage);
    }

    public function findOrFailTeacher($id)
    {
        return ChapterTranscript::whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }

    public function findOrFail($id)
    {
        return ChapterTranscript::query()->with('chapter',function ($q){
            return $q->withoutGlobalScope('published');
        })->findOrFail($id);
    }

    public function destroy($id)
    {
        return ChapterTranscript::destroy($id);
    }

    public function save(ChapterTranscript $chapterTranscript)
    {
        $chapterTranscript->save();
        return $chapterTranscript;
    }

    public function create(array $data)
    {
        return ChapterTranscript::create($data);

    }

    public static function getNewObject()
    {
        return new ChapterTranscript();
    }

    public function confirmThisTranscript(ChapterTranscript $chapterTranscript , $status , $chapter = null)
    {
        $chapter = !is_null($chapter) ? $chapter : app(ChapterRepositoryInterface::class)->newModel();
        $chapter->title = $chapterTranscript->title;
        $chapter->description = $chapterTranscript->description;
        $chapter->view = $chapterTranscript->view;
        $chapter->course_id = $chapterTranscript->course_id;
        $chapter->status = $status;
        return $chapter;
    }

    public function findTeacherChapter($id)
    {
        return ChapterTranscript::whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }

    public static function getNew()
    {
        return ChapterTranscript::where('status',ChapterEnum::TRANSCRIPT_PENDING)->count();

    }
}
