<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\StorageEnum;
use App\Enums\TicketEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Rules\ReCaptchaRule;
use App\Traits\ChatPanel;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class Ticket extends BaseComponent
{
    use WithFileUploads , ChatPanel;
    public mixed $user;
    public  $ticket, $recaptcha;
    public $subject, $header, $customStorage,$user_id, $content, $main_file = [], $priority, $status, $child = [], $user_name, $answer, $answerFile, $ticketFile = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->ticketRepository = app(TicketRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->disk = getDisk(storage: StorageEnum::PUBLIC);
        $this->customStorage = StorageEnum::PUBLIC;
    }

    public function mount($action, $id = null)
    {
        $this->user = auth()->user();
        SEOMeta::setTitle($this->settingRepository->getRow('title') . '-' . ' پشتیبانی ');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword', []));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title') . '-' . ' پشتیبانی ');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title') . '-' . ' پشتیبانی ');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title') . '-' . ' پشتیبانی ');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->ticket = $this->ticketRepository->find($id);
            $this->header = $this->ticket->subject;
            $this->subject = $this->ticket->subject;
            $this->user_id = $this->ticket->user_id;
            $this->user_name = $this->ticket->user->user_name;
            $this->content = $this->ticket->content;
            $this->ticketFile = $this->ticket->file;
            $this->priority = $this->ticket->priority;
            $this->status = $this->ticket->status;
            $this->child = $this->ticket->children;
        }
        $this->data['priority'] = TicketEnum::getPriority();
        $this->data['subject'] = $this->settingRepository->getRow('subject', []);
    }

    public function addFile()
    {
        if (sizeof($this->main_file) < 5) {
            $this->main_file[] = null;
        }
    }

    public function deleteFile($key)
    {
        unset($this->main_file[$key]);
    }


    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->newAnswer();
        elseif ($this->mode == self::CREATE_MODE) {
            $id = $this->saveInDataBase($this->ticketRepository->newTicketObject());
            $this->reset(['subject', 'content', 'main_file', 'priority', 'recaptcha']);
            return redirect()->route('user.ticket', ['edit', $id]);
        }
    }

    public function saveInDataBase($model)
    {
        $this->resetErrorBag();
        $this->validate(
            [
                'subject' => ['required', 'string', 'max:250'],
                'content' => ['required', 'string', 'max:95000'],
                'main_file' => [Rule::requiredIf(function(){
                    return sizeof($this->file) > 0;
                }), 'array', 'max:5'],
                'main_file.*' => ['required', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                'priority' => ['required', 'in:' . implode(',', array_keys(TicketEnum::getPriority()))],
            ],
            [],
            [
                'subject' => 'موضوع',
                'content' => 'متن',
                'main_file' => 'فایل',
                'main_file.*' => 'فایل',
                'priority' => 'اولویت',
            ]
        );
        $model->subject = $this->subject;
        $model->content = $this->content;
        $model->file = $this->upload();
        $model->parent_id = null;
        $model->sender_id  = auth()->id();
        $model->user_id  = auth()->id();
        $model->sender_type  = TicketEnum::USER;
        $model->status  = TicketEnum::PENDING;
        $model->priority = $this->priority;
        $model = $this->ticketRepository->save($model);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        return $model->id;
    }

    public function sendChatText(): void
    {
        $this->validate(
            [
                'chatText' => ['required', 'string', 'max:6500'],
                'file' => ['nullable','file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            ],
            [],
            [
                'chatText' => 'پاسخ',
                'file' => 'فایل',
            ]
        );
        $new = $this->ticketRepository->newTicketObject();
        $new->subject = $this->subject;
        $new->user_id  = $this->ticket->user_id;
        $new->parent_id = $this->ticket->id;
        $new->content = $this->chatText;
        $new->file =  $this->uploadFiles('tickets');
        $new->sender_id = auth()->id();
        $new->sender_type = TicketEnum::USER;
        $new->priority = $this->ticket->priority;
        $new->status = TicketEnum::ANSWERED;
        $this->ticket->status = TicketEnum::USER_ANSWERED;
        $this->ticketRepository->save($this->ticket);
        $this->ticketRepository->save($new);
        $this->child->push($new);
        $this->emitNotify('پیام با موفقیت ارسال شد');
        $this->reset(['file', 'chatText', 'recaptcha']);
    }


    public function uploadFile()
    {
        // upon form submit, this function till fill your progress bar
    }

    public function upload(): string
    {
        $file = [];
        foreach ($this->main_file as $value) {
            if (isset($value) && !empty($value))
                $file[] = 'storage/' . $this->disk->put('tickets', $value);
        }

        return implode(',',$file);
    }

    public function render()
    {
        return view('site.client.ticket')->extends('site.layouts.client.client');
    }
}
