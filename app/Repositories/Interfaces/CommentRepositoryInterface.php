<?php


namespace App\Repositories\Interfaces;


use App\Models\Comment;

interface CommentRepositoryInterface
{
    public static function getNew();

    public function getAllAdminList($search , $status , $for , $pagination , $active = true);

    public function getByConditionCount($col , $operator , $value , $active = true);

    public function find($id , $active = true);

    public function delete(Comment $comment);

    public function save(Comment $comment);

    public function destroy($id);

    public function create(array $data);

    public function getUserComments($where = [],$active = true);
}
