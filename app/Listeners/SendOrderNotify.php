<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\OrderEnum;
use App\Events\OrderEvent;
use App\Mail\OrderMail;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderNotify
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
     * @param  \App\Events\OrderEvent  $event
     * @return void
     */
    public function handle(OrderEvent $event): void
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $SendRepository = app(SendRepositoryInterface::class);
        $OrderNoteRepository = app(OrderNoteRepositoryInterface::class);
        $raw_text = match ($event->order->status) {
            OrderEnum::STATUS_PROCESSING => $SettingRepository->getRow('order_processing'),
            OrderEnum::STATUS_CANCELLED => $SettingRepository->getRow('order_cancelled'),
            OrderEnum::STATUS_REFUNDED => $SettingRepository->getRow('order_refunded'),
            OrderEnum::STATUS_COMPLETED => $SettingRepository->getRow('order_completed'),
            default => null,
        };
        if (!empty($raw_text)){
            $titles = '';
            foreach ($event->order->details as $item)
                $titles .= ','.$item->course->title;

            $send_type =$SettingRepository->getRow('send_type');
            $text = str_replace(array_keys($SettingRepository::variables()['orders']),
                [$event->order->tracking_code,$event->order->total_price,trim($titles,','),$event->order->user->name],
                $raw_text);

            try {
                if ($send_type == 'email')
                    Mail::to($event->order->user->email)->send(new OrderMail($text));
                elseif ($send_type == 'sms')
                    $SendRepository->sendSMS($text,$event->order->user->phone);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
            $SendRepository->sendNOTIFICATION($text,$event->order->user->id,NotificationEnum::ORDER,$event->order->id);
            $OrderNoteRepository->create([
                'note' => $text,
                'is_user_note' => true,
                'is_read' => false,
                'order_id' => $event->order->id,
                'user_id' => null,
            ]);
        }
    }
}
