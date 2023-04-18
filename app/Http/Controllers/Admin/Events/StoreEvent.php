<?php

namespace App\Http\Controllers\Admin\Events;

use App\Enums\EventEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;

class StoreEvent extends BaseComponent
{
    public  $header;
    public  $title , $body , $event , $orderBy , $count , $category , $vars = [] , $course , $organ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->eventRepository = app(EventRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->organRepository = app(OrganRepositoryInterface::class);
    }

    public function mount($action)
    {
        $this->authorizing('show_events');
        self::set_mode($action);

        if ($this->mode <> self::CREATE_MODE)
            return abort(404);

        $this->data['event'] = EventEnum::getEvents();
        $this->data['orderBy'] = EventEnum::getOrderBy();
        $this->data['count'] = EventEnum::getNumbers();
        $this->data['category'] = EventEnum::getTargets();
        $this->header = 'رویداد جدید';
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        $this->data['organs'] = $this->organRepository->getAll()->pluck('title','id');
        $this->count = EventEnum::ALL;
    }

    public function updatedCategory($value)
    {
        if (!empty($value))
            $this->vars = $this->eventRepository::getParams()[$value];
    }

    public function store()
    {
        $this->authorizing('edit_events');
        $this->validate([
            'title' => ['required','string','max:120'],
            'body' => ['required','string','max:200000'],
            'event' => ['required','string','in:'.implode(',',array_keys(EventEnum::getEvents()))],
            'count' => ['required','integer','in:'.implode(',',array_keys(EventEnum::getNumbers()))],
            'orderBy' => ['required','in:'.implode(',',array_keys(EventEnum::getOrderBy()))],
            'category' => ['required',Rule::in(array_keys($this->data['category']))],
            'course' => [$this->category == EventEnum::TARGET_COURSES ? 'required' : 'nullable','exists:courses,id'],
            'organ' => [$this->category == EventEnum::TARGET_ORGANS ? 'required' : 'nullable','exists:organs,id'],
        ],[],[
            'title' => 'عنوان',
            'body' => 'متن اصلی',
            'event' => 'عملیات رویداد',
            'count' => 'تعداد کاربر',
            'orderBy' => 'مرتب سازی',
            'category' => 'کاربران هدف',
            'course' => 'دوره امزوشی',
            'organ' => 'آموزشگاه یا سازمان',
        ]);
        $event = $this->eventRepository->create([
            'title' => $this->title,
            'body' => $this->body,
            'event' => $this->event,
            'status' => EventEnum::PENDING,
            'user_id' => Auth::id() ,
            'users_count' => EventEnum::getNumbers()[EventEnum::ALL],
            'order_by' => $this->orderBy,
            'category' => $this->category,
            'course_id' => $this->course,
            'organ_id' => $this->organ,
        ]);
        Artisan::call("jobs:set $event->id --orderBy=$this->orderBy --count=".EventEnum::ALL);
        $this->reset(['title','body','event','orderBy','count','category','course','organ']);
        $this->emitNotify('رویداد با موفقیت ذخیره شد');

    }

    public function render()
    {
        return view('admin.events.store-event')
            ->extends('admin.layouts.admin');
    }
}
