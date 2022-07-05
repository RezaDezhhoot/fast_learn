<?php

namespace App\Http\Controllers\Admin\Tickets;

use App\Enums\TicketEnum;
use App\Http\Controllers\BaseComponent;
use Livewire\WithPagination;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;

class IndexTicket extends BaseComponent
{
    use WithPagination;
    public ?string $status = null , $priority = null , $subject = null , $placeholder = 'شماره یا نام کاربری کاربر';
    protected $queryString = ['status','priority','subject'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->ticketRepository = app(TicketRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = TicketEnum::getStatus();
        $this->data['priority'] = TicketEnum::getPriority();
        $this->data['subject'] = $this->settingRepository->getRow('subject',[]);
    }

    public function render()
    {
        $tickets =  $this->ticketRepository->getAllAdminList($this->search,$this->status,$this->priority,$this->subject,$this->per_page);
        return view('admin.tickets.index-ticket',['tickets' => $tickets])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_tickets');
        $ticket =  $this->ticketRepository->find($id);
        $this->ticketRepository->delete($ticket);
    }
}
