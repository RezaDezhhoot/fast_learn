<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SmsSetting extends BaseComponent
{
    public $header , $variables;
    public $order_completed , $order_processing , $order_cancelled , $order_refunded;
    public $ticket_new , $ticket_answer;
    public $auth_login , $auth_register;
    public $exam_passed , $exam_rejected;

    public $teacher_apply_reject , $teacher_apply_confirm;
    public $new_course_accepted , $new_course_rejected;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_sms');
        $this->header = 'تنظیمات متن های ارسالی';
        $this->variables = $this->settingRepository::variables();
        $this->order_completed = $this->settingRepository->getRow('order_completed');
        $this->order_processing = $this->settingRepository->getRow('order_processing');
        $this->order_cancelled = $this->settingRepository->getRow('order_cancelled');
        $this->order_refunded = $this->settingRepository->getRow('order_refunded');
        $this->ticket_new = $this->settingRepository->getRow('ticket_new');
        $this->ticket_answer = $this->settingRepository->getRow('ticket_answer');
        $this->auth_login = $this->settingRepository->getRow('auth_login');
        $this->auth_register = $this->settingRepository->getRow('auth_register');
        $this->exam_passed = $this->settingRepository->getRow('exam_passed');
        $this->exam_rejected = $this->settingRepository->getRow('exam_rejected');

        $this->teacher_apply_confirm = $this->settingRepository->getRow('teacher_apply_confirm');
        $this->teacher_apply_reject = $this->settingRepository->getRow('teacher_apply_reject');

        $this->new_course_accepted = $this->settingRepository->getRow('new_course_accepted');
        $this->new_course_rejected = $this->settingRepository->getRow('new_course_rejected');
    }

    public function render()
    {
        return view('admin.settings.sms-setting')->extends('admin.layouts.admin');
    }

    public function store()
    {
        $this->authorizing('edit_settings_sms');
        $this->validate(
            [
                'order_completed' => ['nullable', 'string','max:650'],
                'order_processing' => ['nullable', 'string','max:650'],
                'order_cancelled' => ['nullable', 'string','max:650'],
                'order_refunded' => ['nullable', 'string','max:650'],
                'ticket_new' => ['nullable', 'string','max:650'],
                'ticket_answer' => ['nullable', 'string','max:650'],
                'auth_login' => ['nullable', 'string','max:650'],
                'auth_register' => ['nullable', 'string','max:650'],
                'exam_passed' => ['nullable', 'string','max:650'],
                'exam_rejected' => ['nullable', 'string','max:650'],
                'teacher_apply_confirm' => ['nullable', 'string','max:650'],
                'teacher_apply_reject' => ['nullable', 'string','max:650'],
                'new_course_accepted' => ['nullable', 'string','max:650'],
                'new_course_rejected' => ['nullable', 'string','max:650'],
            ] , [] , [
                'order_completed' => 'تکمیل سفارش',
                'order_processing' => 'در حال پردازش',
                'order_cancelled' => 'در انتظار بازگشت وجه',
                'order_refunded' => 'بازگشت وجه',
                'ticket_new' => 'ارسال تیکت جدید',
                'ticket_answer' => 'پاسخ به تیکت',
                'auth_login' => 'ورود',
                'auth_register' => 'ثبت نام',
                'exam_passed' => 'قبول شدن در ازمون',
                'exam_rejected' => 'رد شدن در ازمون',
                'teacher_apply_confirm' => 'تایید درخواست برای مدرس شدن',
                'teacher_apply_reject' => 'رد درخواست برای مدرس شدن',
                'new_course_accepted' => 'تایید شروع دوره جدید',
                'new_course_rejected' => 'رد شروع دوره جدید',
            ]
        );
        $this->settingRepository::updateOrCreate(['name' => 'order_completed'], ['value' => $this->order_completed]);
        $this->settingRepository::updateOrCreate(['name' => 'order_processing'], ['value' => $this->order_processing]);
        $this->settingRepository::updateOrCreate(['name' => 'order_cancelled'], ['value' => $this->order_cancelled]);
        $this->settingRepository::updateOrCreate(['name' => 'order_refunded'], ['value' => $this->order_refunded]);
        $this->settingRepository::updateOrCreate(['name' => 'ticket_new'], ['value' => $this->ticket_new]);
        $this->settingRepository::updateOrCreate(['name' => 'ticket_answer'], ['value' => $this->ticket_answer]);
        $this->settingRepository::updateOrCreate(['name' => 'auth_login'], ['value' => $this->auth_login]);
        $this->settingRepository::updateOrCreate(['name' => 'auth_register'], ['value' => $this->auth_register]);
        $this->settingRepository::updateOrCreate(['name' => 'exam_passed'], ['value' => $this->exam_passed]);
        $this->settingRepository::updateOrCreate(['name' => 'exam_rejected'], ['value' => $this->exam_rejected]);

        $this->settingRepository::updateOrCreate(['name' => 'teacher_apply_confirm'], ['value' => $this->teacher_apply_confirm]);
        $this->settingRepository::updateOrCreate(['name' => 'teacher_apply_reject'], ['value' => $this->teacher_apply_reject]);

        $this->settingRepository::updateOrCreate(['name' => 'new_course_accepted'], ['value' => $this->new_course_accepted]);
        $this->settingRepository::updateOrCreate(['name' => 'new_course_rejected'], ['value' => $this->new_course_rejected]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }
}
