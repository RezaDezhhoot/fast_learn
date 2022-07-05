<?php


namespace App\Repositories\Interfaces;


use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function create(array $data);

    public function getAllAdminList($search , $type , $subject , $pagination);

    public function delete(Notification $notification);

    public function find($id);
}
