<?php

namespace App\Repositories\Classes;
use App\Models\Chapter;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;

class ChapterRepository implements ChapterRepositoryInterface
{
    public function getAllAdmin($search, $course, $status, $pagination)
    {
        return Chapter::query()
            ->withoutGlobalScope('published')
            ->latest()->when($course , function ($q) use ($course) {
               return $q->whereHas('course',function ($q) use ($course) {
                   return $q->where('id',$course);
               });
            })->when($status,function ($q) use ($status){
                return $q->where('status',$status);
            })->search($search)->paginate($pagination);
    }

    public function findOrFail($id)
    {
        return Chapter::query()->withoutGlobalScope('published')->findOrFail($id);
    }

    public function newModel(): Chapter
    {
        return new Chapter();
    }

    public function destroy($id)
    {
        Chapter::destroy($id);
    }

    public function save(Chapter $chapter)
    {
        $chapter->save();
        return $chapter;
    }

    public function alL($relation = null , $id = null , $foreign_ley = null)
    {
        return $relation ? Chapter::query()->withoutGlobalScope('published')
            ->latest()->whereHas($relation,function ($q) use($id , $foreign_ley) {
            return $q->where($foreign_ley , $id);
        })->get() : Chapter::all();
    }

    public function getAllTeacher($search, $course, $status, $pagination)
    {
        return Chapter::latest('id')->whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->when($course,function ($q) use ($course) {
            return $q->where('course_id',$course);
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($pagination);
    }

    public function getAllOrgan($search, $course, $status, $pagination)
    {
        return Chapter::latest('id')->whereHas('course',function ($q){
            return $q->whereHas('organ',function ($q){
                return $q->whereIn('id',Auth::user()->organs->pluck('id'));
            });
        })->when($course,function ($q) use ($course) {
            return $q->where('course_id',$course);
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($pagination);
    }

    public function findOrFailTeacher($id)
    {
        return Chapter::whereHas('course',function ($q){
            return $q->whereHas('teacher',function ($q){
                return $q->where('user_id',Auth::id());
            });
        })->findOrFail($id);
    }

    public function findOrFailOrgan($id)
    {
        return Chapter::whereHas('course',function ($q){
            return $q->whereHas('organ',function ($q){
                return $q->whereIn('id',Auth::user()->organs->pluck('id'));
            });
        })->findOrFail($id);
    }
}
