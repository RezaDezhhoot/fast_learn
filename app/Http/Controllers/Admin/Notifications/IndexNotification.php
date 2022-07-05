<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Enums\NotificationEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use Livewire\WithPagination;

class IndexNotification extends BaseComponent
{
    use WithPagination;
    public ?string $subject = null , $type = null, $placeholder = 'نام کاربری یا شماره همراه کاربری';
    protected $queryString = ['type','subject'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->notificationRepository = app(NotificationRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['type'] = NotificationEnum::getType();
        $this->data['subject'] = NotificationEnum::getSubject();
    }

    public function render()
    {
        $this->authorizing('show_notifications');
        $notification = $this->notificationRepository->getAllAdminList($this->search,$this->type,$this->subject,$this->per_page);
        return view('admin.notifications.index-notification',['notification' => $notification])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_notifications');
        $notification = $this->notificationRepository->find($id);
        $this->notificationRepository->delete($notification);
    }
}
