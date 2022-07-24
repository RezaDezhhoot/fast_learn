<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Enums\PaymentEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\LogRepositoryInterface;
use Livewire\WithPagination;

class IndexLog extends BaseComponent
{
    use WithPagination;

    public $user  , $subject , $placeholder = 'شناسه یا شماره همراه کاربر';

    protected $queryString = ['user','subject'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->logRepository = app(LogRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_logs');
        $this->data['subject'] = PaymentEnum::getSubjects();
    }

    public function render()
    {
        $logs = $this->logRepository->getAllAdmin($this->user,$this->subject,$this->per_page);
        return view('admin.logs.index-log',['logs'=>$logs])->extends('admin.layouts.admin');
    }

    public function downloadDetails($id)
    {
        $this->authorizing('show_logs');
        $disk = getDisk(StorageEnum::PUBLIC);
        $now = now()->format('Y_m_d');
        $filename = "logs_{$id}_{$now}.txt";
        $log = $this->logRepository->find($id);
        $disk->put("logs_folder/$filename",'properties:'.$log->properties."\nsubject details:".$log->subject."\ncauser deatals:".$log->causer);
        return response()->download(storage_path("app/public/logs_folder/$filename"), "logs_{$now}.txt")
            ->deleteFileAfterSend(true);
    }
}
