<?php

namespace App\Listeners;

use App\Enums\ContactUsEnum;
use App\Events\ContactusEvent;
use App\Mail\ContactUsMail;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class ContactUsListener
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
     * @param ContactusEvent $event
     * @return void
     */
    public function handle(ContactusEvent $event)
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $SendRepository = app(SendRepositoryInterface::class);
        $send_type = $SettingRepository->getRow('send_type');
        $text = '';
        try {
            if ($event->action == ContactUsEnum::EMAIL_ACTION)
                Mail::to($event->contact->email)->send(new ContactUsMail($text));
            elseif ($event->action == ContactUsEnum::SMS_ACTION)
                $SendRepository->sendSMS($text,$event->contact->phone);
        }  catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
