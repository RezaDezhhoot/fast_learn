<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\TicketEnum;
use App\Events\TicketEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class TicketListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TicketEvent  $event
     * @return void
     */
    public function handle(TicketEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $raw_text = match ($event->ticket->status){
            TicketEnum::ADMIN_SENT => $SettingRepository->getRow('ticket_new'),
            TicketEnum::ANSWERED => $SettingRepository->getRow('ticket_answer'),
            default => null
        };
        if (!empty($raw_text))
        {
            $text = custom_text('tickets',$raw_text,[
                $event->ticket->subject,$event->ticket->priority_label,$event->ticket->user->name
            ]);
            $subject_label = 'پشتیبانی';
            app(NotificationRepositoryInterface::class)
                ->send($event->ticket->user, NotificationEnum::TICKET, $subject_label, $text, 'emails.ticket', $event->ticket->user->id,
                    [
                        'text' => $text,
                        'name' => $SettingRepository->getRow('name'),
                    ]
                );
        }
    }
}
