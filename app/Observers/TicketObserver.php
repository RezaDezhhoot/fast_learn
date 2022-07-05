<?php

namespace App\Observers;

use App\Enums\NotificationEnum;
use App\Enums\TicketEnum;
use App\Models\Ticket;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $SendRepository = app(SendRepositoryInterface::class);
        $raw_text = match ($ticket->status){
            TicketEnum::ADMIN_SENT => $SettingRepository->getRow('ticket_new'),
            TicketEnum::ANSWERED => $SettingRepository->getRow('ticket_answer'),
            default => null
        };
        if (!empty($raw_text))
        {
            $text = str_replace(array_keys($SettingRepository::variables()['tickets']),
                [$ticket->subject,$ticket->priority,$ticket->user->name], $raw_text);
            $SendRepository->sendSMS($text,$ticket->user->phone);
            $SendRepository->sendNOTIFICATION($text,$ticket->user->id,NotificationEnum::TICKET,$ticket->user->id);
        }
    }

    /**
     * Handle the Ticket "updated" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function updated(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the Ticket "deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function deleted(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function restored(Ticket $ticket)
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function forceDeleted(Ticket $ticket)
    {
        //
    }
}
