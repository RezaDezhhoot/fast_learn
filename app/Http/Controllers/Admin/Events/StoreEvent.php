<?php

namespace App\Http\Controllers\Admin\Events;

use App\Enums\EventEnum;
use App\Http\Controllers\BaseComponent;
use App\Jobs\ProcessEvent;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StoreEvent extends BaseComponent
{
    public  $header;
    public  $title , $body , $event;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->eventRepository = app(EventRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action)
    {
        $this->authorizing('show_events');
        self::set_mode($action);

        if ($this->mode <> self::CREATE_MODE)
            return abort(404);

        $this->data['event'] = EventEnum::getEvents();
        $this->header = 'رویداد جدید';
    }

    public function store()
    {
        $this->authorizing('edit_events');
        $this->validate([
            'title' => ['required','string','max:120'],
            'body' => ['required','string','max:200000'],
            'event' => ['required','string','in:'.implode(',',array_keys(EventEnum::getEvents()))],
        ],[],[
            'title' => 'عنوان',
            'body' => 'متن اصلی',
            'event' => 'عملیات رویداد'
        ]);
        $event = $this->eventRepository->create([
            'title' => $this->title,
            'body' => $this->body,
            'event' => $this->event,
            'status' => EventEnum::PENDING,
            'user_id' => Auth::id()
        ]);


        $users = $this->userRepository->getAll();
        foreach ($users as $item)
            ProcessEvent::dispatch($event,$item)->delay(now()->addSeconds(7));


        $this->reset(['title','body','event']);
        $this->emitNotify('رویداد با موفقیت ذخیره شد');

    }

    public function render()
    {
        return view('admin.events.store-event')
            ->extends('admin.layouts.admin');
    }
}