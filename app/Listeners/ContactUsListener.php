<?php

namespace App\Listeners;

use App\Enums\ContactUsEnum;
use App\Events\ContactusEvent;
use App\Mail\ContactUsMail;
use App\Repositories\Interfaces\SendRepositoryInterface;
use Illuminate\Support\Facades\Log;
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
        $SendRepository = app(SendRepositoryInterface::class);
        try {
            if ($event->action == ContactUsEnum::EMAIL_ACTION)
                $SendRepository->sendEmail(new ContactUsMail($event->text) ,$event->contact->email);
            elseif ($event->action == ContactUsEnum::SMS_ACTION)
                $SendRepository->sendSMS($event->text,$event->contact->phone);
        }  catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
