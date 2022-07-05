<?php


namespace App\Repositories\Classes;


use App\Models\Comment;
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

    public function getAllAdminList($search, $status, $for, $pagination, $active = true)
    {
        return Comment::confirmed($active)->latest('id')->with(['user'])->when($search,function ($query) use ($search){
            return $query->whereHas('user',function ($query) use ($search){
                return is_numeric($search) ?
                    $query->where('phone',$search) : $query->where('name',$search);
            });
        })->when($status,function ($query) use ($status){
            return $query->where('status',$status);
        })->when($for,function ($query) use ($for){
            return $query->where('commentable_type',$for);
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
            ->with(['childrenRecursive'])
            ->whereHas('childrenRecursive',function ($q) {
                return $q->where('user_id',Auth::id());
            })
            ->orWhere($where)
            ->get();
    }
}
