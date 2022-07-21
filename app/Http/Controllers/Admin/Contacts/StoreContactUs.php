<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\Enums\ContactUsEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Events\ContactUsEvent;
use Exception;
use Illuminate\Support\Facades\Log;

class StoreContactUs extends BaseComponent
{
    public $contact , $answer , $status , $answer_action , $header , $result;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->contactUsRepository = app(ContactUsRepositoryInterface::class);
    }

    public function mount($action, $id)
    {
        $this->authorizing('show_contacts');
        $this->set_mode($action);

        if ($this->mode == self::UPDATE_MODE)
        {
            $this->contact = $this->contactUsRepository->findOrFail($id);
            $this->status = $this->contact->status;
            $this->answer = $this->contact->answer;
            $this->result = $this->contact->result;
            $this->answer_action = $this->contact->answer_action;
            $this->header = 'ویرایش درخواست کاربر';
        } else abort(404);

        $this->data['status'] = ContactUsEnum::getStatus();
        $this->data['action'] = ContactUsEnum::getActions();
    }

    public function store()
    {
        $this->resetErrorBag();
        $this->authorizing('edit_contacts');
        $this->validate([
            'status' => ['required','string','in:'.implode(',',array_keys($this->data['status']))],
            'answer' => ['required','string','max:1400'],
            'answer_action' => ['required','string','in:'.implode(',',array_keys($this->data['action']))]
        ],[],[
            'status' => 'وضعیت',
            'answer' => 'پاسخ',
            'answer_action' => 'نحوه ارسال پاسخ'
        ]);
        try {
            ContactUsEvent::dispatchIf(
                ($this->status != $this->contact->status && $this->status == ContactUsEnum::CHECKED),
                $this->contact,
                $this->answer_action,
                $this->answer
            );
            $this->contact->status = $this->status;
            $this->contact->answer = $this->answer;
            $this->result = 'ارسال پاسخ با موفقیت انجام شد';
            $this->contact->result = $this->result;
            $this->contact->answer_action = $this->answer_action;
            $this->contactUsRepository->save($this->contact);
            $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
        } catch (Exception $e) {
            $this->emitNotify('خطایی در هنگام ارسال پاسخ رخ داده است','warning');
            Log::error($e->getMessage());
            $this->result = $e->getMessage();
            $this->contactUsRepository->update([
                'result' => $this->result,
                'status' => ContactUsEnum::FAILED,
                'answer_action' => $this->answer_action
            ],$this->contact);
        }
    }

    public function render()
    {
        return view('admin.contacts.store-contact-us')->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_contacts');
        $this->contactUsRepository->destroy($this->contact->id);
        return redirect()->route('admin.contact');
    }
}
