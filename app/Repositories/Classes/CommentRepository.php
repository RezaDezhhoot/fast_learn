<?php


namespace App\Repositories\Classes;


use App\Enums\CommentEnum;
use App\Models\Comment;
use App\Observers\CommentObserver;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @return mixed
     */
    public static function getNew()
    {
        return  Comment::getNew();
    }

    public function getAllAdminList($search, $status, $for, $pagination , $case = null, $active = true)
    {
        return Comment::confirmed($active)->latest('id')->with(['user'])->when($search,function ($query) use ($search){
            return $query->whereHas('user',function ($query) use ($search){
                return is_numeric($search) ?
                    $query->where('phone',$search) : $query->where('name',$search);
            });
        })->when($status,function ($query) use ($status){
            return $query->where('status',$status);
        })->when($for,function ($query) use ($for,$case){
            return $query->where('commentable_type',$for)->when($case,function ($q) use ($case){
                return $q->where('commentable_id',$case);
            });
        })->paginate($pagination);
    }

    public function getByConditionCount($col, $operator, $value, $active = true)
    {
        return Comment::confirmed($active)->where("$col","$operator","$value")->count();
    }

    public function find($id , $active = true)
    {
        return Comment::confirmed($active)->with(['childrenRecursive'])->findOrFail($id);
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    public function destroy($id)
    {
        return Comment::destroy($id);
    }

    public function save(Comment $comment)
    {
        $comment->save();
        return $comment;
    }

    public function create(array $data)
    {
        return Comment::create($data); // TODO: Implement create() method.
    }

    public function getUserComments($where = [],$active = true)
    {
        return Comment::confirmed($active)
            ->latest()
            ->with(['childrenRecursive'])
            ->whereHas('childrenRecursive',function ($q) {
                return $q->where('user_id',Auth::id());
            })
            ->orWhere($where)
            ->get();
    }

    public function getAllTeacher($search, $status, $pagination, $case = null, $active = true)
    {
        return Comment::confirmed($active)
            ->where('commentable_type',CommentEnum::COURSE)
            ->latest('id')
            ->with(['user'])
            ->where(function ($q){
                $courses_id = Auth::user()->teacher->courses->pluck('id')->toArray();
                return $q->whereIn('commentable_id',$courses_id);
            })
            ->when($search,function ($query) use ($search){
            return $query->whereHas('user',function ($query) use ($search){
                return is_numeric($search) ?
                    $query->where('phone',$search) : $query->where('name',$search);
            });
        })->when($status,function ($query) use ($status){
            return $query->where('status',$status);
        })->paginate($pagination);
    }

    public function findTeacher($id)
    {
        return Comment::where('commentable_type',CommentEnum::COURSE)
            ->with(['user'])
            ->where(function ($q){
                $courses_id = Auth::user()->teacher->courses->pluck('id')->toArray();
                return $q->whereIn('commentable_id',$courses_id);
            })->findOrFail($id);
    }

    public static function observe()
    {
        Comment::observe(CommentObserver::class);
    }
}
