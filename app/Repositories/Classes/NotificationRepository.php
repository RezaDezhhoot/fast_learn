<?php


namespace App\Repositories\Classes;

use App\Enums\JobEnum;
use App\Enums\NotificationEnum;
use App\Models\Notification;
use App\Notifications\Queue\SendEmail as SendEmailOnQueue;
use App\Notifications\Queue\SendSMS as SendSMSOnQueue;
use App\Notifications\SendEmail;
use App\Notifications\SendNotification;
use App\Notifications\SendSMS;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function getAllAdminList($search, $type, $subject, $pagination)
    {
        return Notification::with(['user'])->latest('id')->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($query) use ($search) {
                return is_numeric($search) ?
                    $query->where('phone',$search) : $query->where('user_name',$search);
            });
        })->when($type,function ($query) use ($type){
            return $query->where('type',$type);
        })->when($subject,function ($query) use ($subject){
            return $query->where('subject',$subject);
        })->paginate($pagination);
    }


    /**
     * @param Notification $notification
     * @return mixed
     */
    public function delete(Notification $notification)
    {
        return $notification->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Notification::findOrFail($id);
    }

    public function create(array $data)
    {
        return Notification::create($data);
    }

    public function getByWhere(array $where,$from_date , $to_date)
    {
        return Notification::latest('id')->where($where)->whereBetween('created_at',[$from_date." 00:00:00", $to_date." 23:59:59"])->cursor();
    }

    public function send($user , $subject , $subject_label , $text ,$view , $model_id = null , $data = [] )
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $send_method = $SettingRepository->getRow('send_type');
        $email_username = $SettingRepository->getRow('email_username');
        $name = $SettingRepository->getRow('name');
        $notify_should_be_queueable = $SettingRepository->getRow('notify_should_be_queueable');
        try {
            switch ($send_method) {
                case NotificationEnum::SMS_METHOD:
                    $notify_should_be_queueable ?
                        $user->notify((new SendSMSOnQueue($text , $user->phone))
                            ->onQueue(JobEnum::SMS)) :
                        $user->notify((new SendSMS($text , $user->phone)));
                    break;
                case NotificationEnum::EMAIL_METHOD:
                    $notify_should_be_queueable ?
                        $user->notify((new SendEmailOnQueue($text, $subject_label, $view, $email_username, $name , $data))
                            ->onQueue(JobEnum::EMAIL)) :
                        $user->notify(new SendEmail($text, $subject_label, $view, $email_username, $name , $data));
                    break;
                case NotificationEnum::BOTH_METHODS:
                    if ($notify_should_be_queueable) {
                        $user->notify((new SendSMSOnQueue($text , $user->phone))
                            ->onQueue(JobEnum::SMS));
                        $user->notify((new SendEmailOnQueue($text, $subject_label, $view, $email_username, $name , $data))
                            ->onQueue(JobEnum::EMAIL));
                    } else {
                        $user->notify(new SendSMS($text , $user->phone));
                        $user->notify(new SendEmail($text, $subject_label, $view, $email_username, $name , $data));
                    }
                    break;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        $user->notify(new SendNotification($text,$user->id,$subject,$model_id));
    }
}
