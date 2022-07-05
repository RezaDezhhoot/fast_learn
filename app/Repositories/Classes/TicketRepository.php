<?php


namespace App\Repositories\Classes;

use App\Models\Ticket;
use App\Models\User;
use App\Observers\TicketObserver;
use App\Repositories\Interfaces\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    public function getAllAdminList($search, $status, $priority, $subject, $pagination)
    {
        return Ticket::parent(true)->latest('id')->with(['user'])->when($status, function ($query) use ($status) {
            return $query->where('status' , $status);
        })->when($priority, function ($query) use ($priority) {
            return $query->where('priority' , $priority);
        })->when($subject, function ($query) use ($subject) {
            return $query->where('subject' , $subject);
        })->when($search,function ($query) use ($search){
            return $query->whereHas('user',function ($query) use ($search){
                return is_numeric($search) ?
                    $query->where('phone',$search) : $query->where('user_name',$search);
            });
        })->paginate($pagination);
    }

    public function save(Ticket $ticket)
    {
        $ticket->save();
        return $ticket;
    }

    public function delete(Ticket $ticket)
    {
        return $ticket->delete();
    }

    public function find($id)
    {
        return Ticket::findOrFail($id);
    }

    public function newTicketObject()
    {
        return new Ticket();
    }

    public static function getNew()
    {
        // TODO: Implement getNew() method.
        return Ticket::getNew();
    }

    public function create(User $user, array $data)
    {
        return $user->tickets()->create($data);
        // TODO: Implement create() method.
    }

    public function userTicketFind(User $user, $id)
    {
        return $user->tickets()->findOrFail($id);
        // TODO: Implement userTicketFind() method.
    }

    public function getUserTickets(User $user)
    {
        return $user->tickets()->latest('id')->paginate(25);
    }

    public static function observe()
    {
        Ticket::observe(TicketObserver::class);
    }
}
