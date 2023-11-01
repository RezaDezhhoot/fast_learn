<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Enums\StorageEnum;
use App\Enums\TicketEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\User;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\ChatPanel;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class StoreTicket extends BaseComponent
{
    use ChatPanel , WithFileUploads;

    public  $ticket ;
    public $subject , $header , $user , $content , $main_file , $priority , $status , $child = [] , $user_name , $answer , $answerFile;

    public $customStorage ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->ticketRepository = app(TicketRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
        $this->customStorage = StorageEnum::PUBLIC;
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_tickets');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->ticket = $this->ticketRepository->find($id);
            $this->header = $this->ticket->subject;
            $this->subject =  $this->ticket->subject;
            $this->user = $this->userRepository->find($this->ticket->user_id)->phone;
            $this->user_name = $this->ticket->user->user_name;
            $this->content = $this->ticket->content;
            $this->main_file = $this->ticket->file;
            $this->priority = $this->ticket->priority;
            $this->status = $this->ticket->status;
            $this->child = $this->ticket->children;
        } elseif($this->mode == self::CREATE_MODE) $this->header = 'تیکت جدید';else abort(404);
        $this->data['priority'] = TicketEnum::getPriority();
        $this->data['status'] = TicketEnum::getStatus();
        $this->data['subject'] = $this->settingRepository->getRow('subject',[]);
        $this->data['users'] = [];
    }

    public function store()
    {
        $this->authorizing('edit_tickets');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->ticket);
        elseif($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->ticketRepository->newTicketObject());
            $this->reset(['subject','user','content','main_file','priority','status']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate(
            [
                'subject' => ['required','string','max:250'],
                'user' => ['required','exists:users,id'],
                'content' => ['required','string','max:95000'],
                'main_file' => ['array','nullable'],
                'priority' => ['required','in:'.implode(',',array_keys(TicketEnum::getPriority()))],
            ] , [] , [
                'subject' => 'موضوع',
                'user' => 'شماره کاربر',
                'content' => 'متن',
                'main_file' => 'فایل',
                'priority' => 'اولویت',
            ]
        );
        $model->subject = $this->subject;
        $model->user_id = $this->user;
        $model->content = $this->content;
        $model->file = ($this->mode == self::UPDATE_MODE) ? implode(',',$this->main_file) : $this->main_file;
        $model->parent_id = null;
        $model->sender_id  = auth()->id();
        $model->sender_type  = TicketEnum::ADMIN;
        $model->priority = $this->priority;
        $model->status = TicketEnum::ADMIN_SENT;
        $this->ticketRepository->save($model);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_tickets');
        $this->ticketRepository->delete($this->ticket);
        return redirect()->route('admin.ticket');
    }

    public function sendChatText(): void
    {
        if ($this->mode == self::UPDATE_MODE) {
            $this->authorizing('edit_tickets');
            $this->validate([
                'chatText' => ['required','string','max:72000'],
                'file' => ['nullable','file','max:20480','mimes:png,jpeg,jpg,rar,zip,pdf']
            ],[],[
                'chatText' => 'متن پیام',
                'file' => 'فایل',
            ]);
            $new = $this->ticketRepository->newTicketObject();
            $new->subject = $this->subject;
            $new->user_id  = $this->ticket->user_id;
            $new->parent_id = $this->ticket->id;
            $new->content = $this->chatText;
            $new->file = $this->uploadFiles('tickets');
            $new->sender_id = auth()->id();
            $new->sender_type = TicketEnum::ADMIN;
            $new->priority = $this->priority;
            $new->status = TicketEnum::ANSWERED;
            $this->ticket->status = TicketEnum::ANSWERED;
            $this->ticketRepository->save($this->ticket);
            $this->ticketRepository->save($new);
            $this->child->push($new);
            $this->reset(['chatText','file']);
            $this->emitNotify('پیا با موفقیت ارسال شد');
        }
    }


    public function searchUser()
    {
        $this->data['users'] = User::query()
            ->select([DB::raw("CONCAT(`users`.`name`,'-',`users`.`phone`,'-',`users`.`email`) as title"),'id'])
            ->search($this->user)
            ->take(10)
            ->get()->pluck('title','id')->toArray();
    }


    public function delete($key)
    {
        $this->authorizing('delete_tickets');
        $ticket = $this->child[$key];
        $this->ticketRepository->delete($ticket);
        unset($this->child[$key]);
    }

    public function render()
    {
        return view('admin.tickets.store-ticket')->extends('admin.layouts.admin');
    }
}
