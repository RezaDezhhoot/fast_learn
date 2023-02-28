<?php


namespace App\Repositories\Interfaces;


use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function create(array $data);

    public function getAllAdminList($search , $type , $subject , $pagination);

    public function delete(Notification $notification);

    public function find($id);

    public function getByWhere(array $where,$from_date , $to_date);

    public function send($user , $subject , $subject_label , $text ,$view , $model_id = null , $data = []);
}
