<?php

namespace App\Listeners;

use App\Enums\NotificationEnum;
use App\Enums\OrderEnum;
use App\Events\OrderEvent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

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
        $raw_text = match ($event->order->status) {
            OrderEnum::STATUS_PROCESSING => $SettingRepository->getRow('order_processing'),
            OrderEnum::STATUS_CANCELLED => $SettingRepository->getRow('order_cancelled'),
            OrderEnum::STATUS_REFUNDED => $SettingRepository->getRow('order_refunded'),
            OrderEnum::STATUS_COMPLETED => $SettingRepository->getRow('order_completed'),
            default => null,
        };
        if (!empty($raw_text)){
            $titles = '';
            foreach ($event->order->details as $item) $titles .= ','.$item->course->title;

            $text = custom_text('orders',$raw_text,[
                $event->order->tracking_code,$event->order->total_price,trim($titles,','),$event->order->user->name
            ]);

            $subject_label = 'سفارش های کاربر';
            app(NotificationRepositoryInterface::class)
                ->send($event->order->user, NotificationEnum::ORDER, $subject_label, $text, 'emails.order', $event->order->id,
                [
                    'text' => $text,
                    'name' => $SettingRepository->getRow('name'),
                ]
            );
            app(OrderNoteRepositoryInterface::class)->create([
                'note' => $text,
                'is_user_note' => true,
                'is_read' => false,
                'order_id' => $event->order->id,
                'user_id' => null,
            ]);
        }
    }
}
