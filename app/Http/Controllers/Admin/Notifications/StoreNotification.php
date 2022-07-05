<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Enums\NotificationEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class StoreNotification extends BaseComponent
{
    public $header  , $content , $type , $subject , $user ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->notificationRepository = app(NotificationRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_notifications');
        $this->set_mode($action);
        if ($this->mode == self::CREATE_MODE) {
            $this->header = 'اعلان جدید';
            $this->mode = $action;
            $this->data['type'] = NotificationEnum::getType();
            $this->data['subject'] = NotificationEnum::getSubject();
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_notifications');
        $filed = [
            'subject' => ['required', 'string','in:'.implode(',',array_keys($this->data['subject']))],
            'content' => ['required', 'string','max:250'],
            'type' => ['required','string' ,'in:'.implode(',',array_keys(NotificationEnum::getType()))],
        ];
        $message = [
            'subject' => 'موضوع',
            'content' => 'متن',
            'type' => 'نوع اعلان',
        ];

        if (isset($this->user) || $this->type == NotificationEnum::PRIVATE) {
            $filed['user'] = ['required','exists:users,phone'];
            $message['user'] = 'شماره کاربر';
        }
        $this->validate($filed,[],$message);
        $notification = [
            'subject' => $this->subject,
            'content' =>  $this->content,
            'type' => $this->type,
            'model' => $this->subject,
            'model_id' => null
        ];
        if ($this->type == NotificationEnum::PRIVATE)
            $notification['user_id'] = $this->userRepository->findBy([['phone',$this->user]])->id;
        else
            $notification['user_id'] = null;

        $this->notificationRepository->create($notification);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        $this->reset(['content','type','user','subject']);
    }


    public function render()
    {
        return view('admin.notifications.store-notification')
            ->extends('admin.layouts.admin');
    }
}
