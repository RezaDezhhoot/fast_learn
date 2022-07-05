<?php


namespace App\Repositories\Interfaces;


use App\Models\Ticket;
use App\Models\User;

interface TicketRepositoryInterface
{
    public function getAllAdminList($search , $status , $priority , $subject , $pagination);

    public function save(Ticket $ticket);

    public function delete(Ticket $ticket);

    public function create(User $user , array $data);

    public function find($id);

    public function userTicketFind(User $user , $id);

    public static function getNew();

    public function newTicketObject();

    public function getUserTickets(User $user);

    public static function observe();
}
