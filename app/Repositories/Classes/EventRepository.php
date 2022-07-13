<?php

namespace App\Repositories\Classes;

use App\Observers\EventObserver;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    public function getAllAdmin($status , $search , $per_page)
    {
        return Event::latest('id')->when($status,function ($q) use ($status){
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function destroy(): int
    {
        return Event::destroy(func_get_args());
    }


    public function find($id)
    {
        return Event::find($id);
    }

    public function findOrFail($id)
    {
        return Event::findOrFail($id);
    }

    public function update(Event $event,$data): bool
    {
        return $event->update($data);
    }

    public function create($data)
    {
        return Event::create($data);
    }

    public function save(Event $event): Event
    {
        $event->save();
        return $event;
    }

    public static function observe()
    {
        Event::observe(EventObserver::class);
    }
}
