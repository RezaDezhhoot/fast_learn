<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Enums\TicketEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class StoreTicket extends BaseComponent
{
    public  $ticket;
    public $subject , $header , $user , $content , $file , $priority , $status , $child = [] , $user_name , $answer , $answerFile;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->ticketRepository = app(TicketRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
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
            $this->file = $this->ticket->file;
            $this->priority = $this->ticket->priority;
            $this->status = $this->ticket->status;
            $this->child = $this->ticket->children;
        } elseif($this->mode == self::CREATE_MODE) $this->header = 'تیکت جدید';else abort(404);
        $this->data['priority'] = TicketEnum::getPriority();
        $this->data['status'] = TicketEnum::getStatus();
        $this->data['subject'] = $this->settingRepository->getRow('subject',[]);
    }

    public function store()
    {
        $this->authorizing('edit_tickets');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->ticket);
        elseif($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->ticketRepository->newTicketObject());
            $this->reset(['subject','user','content','file','priority','status']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate(
            [
                'subject' => ['required','string','max:250'],
                'user' => ['required','exists:users,phone'],
                'content' => ['required','string','max:95000'],
                'file' => ['array','nullable'],
                'priority' => ['required','in:'.implode(',',array_keys(TicketEnum::getPriority()))],
            ] , [] , [
                'subject' => 'موضوع',
                'user' => 'شماره کاربر',
                'content' => 'متن',
                'file' => 'فایل',
                'priority' => 'اولویت',
            ]
        );
        $model->subject = $this->subject;
        $model->user_id = $this->userRepository->findBy([['phone',$this->user]])->id;
        $model->content = $this->content;
        $model->file = ($this->mode == self::UPDATE_MODE) ? implode(',',$this->file) : $this->file;
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


    public function newAnswer()
    {
        if ($this->mode == self::UPDATE_MODE) {
            $this->authorizing('edit_tickets');
            $this->validate(
                [
                    'answer' => ['required', 'string','max:6500'],
                    'answerFile' => ['nullable' , 'max:250','string']
                ] , [] , [
                    'answer' => 'پاسخ',
                    'answerFile' => 'فایل'
                ]
            );
            $new = $this->ticketRepository->newTicketObject();
            $new->subject = $this->subject;
            $new->user_id  = $this->ticket->user_id;
            $new->parent_id = $this->ticket->id;
            $new->content = $this->answer;
            $new->file = $this->answerFile;
            $new->sender_id = auth()->id();
            $new->sender_type = TicketEnum::ADMIN;
            $new->priority = $this->priority;
            $new->status = TicketEnum::ANSWERED;
            $this->ticket->status = TicketEnum::ANSWERED;
            $this->ticketRepository->save($this->ticket);
            $this->ticketRepository->save($new);
            $this->child->push($new);
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
            $this->reset(['answer','answerFile']);
        }
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
