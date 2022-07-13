<?php

namespace App\Http\Controllers\Admin\Events;

use App\Enums\EventEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\EventRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class IndexEvent extends BaseComponent
{
    use WithPagination;

    public ?string $status = null , $placeholder = 'عنوان';
    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->eventRepository = app(EventRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = EventEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_events');
        $events = $this->eventRepository->getAllAdmin($this->status , $this->search , $this->per_page);
        $failed_jobs = DB::table('failed_jobs')->count();
        $jobs = DB::table('jobs')->count();

        return view('admin.events.index-event',['events'=>$events , 'failed_jobs' => $failed_jobs ,'jobs'=>$jobs])
            ->extends('admin.layouts.admin');
    }

    public function retry_jobs()
    {
        $this->authorizing('edit_events');
        Artisan::call('queue:retry all');
        $this->emitNotify('رویداد ها اماده اجرا');
    }

    public function work()
    {
        $this->authorizing('edit_events');
        Artisan::call('cache:clear');
        Artisan::call("queue:work --queue=all --stop-when-empty");
    }

    public function downloadsError($id): BinaryFileResponse
    {
        $disk = getDisk(StorageEnum::PUBLIC);
        $now = now()->format('Y_m_d');
        $filename = "events_error_{$id}_{$now}.txt";
        $disk->put("event_errors/$filename",$this->eventRepository->find($id)->errors);
        return response()->download(storage_path("app/public/event_errors/$filename"), "events_error_{$now}.txt")
            ->deleteFileAfterSend(true);
    }

    public function delete($id)
    {
        $this->authorizing('delete_events');
        $this->eventRepository->destroy($id);
        $this->emitNotify('رویداد با موفقیت حذف شد');
    }

    public function deleteGroup($status)
    {
        $this->authorizing('delete_events');
        if ($status == 'jobs') {
            DB::table('jobs')->delete();
            $this->emitNotify('رویداد های اماده با موفقیت پاک سازی شد');
        } elseif ($status == 'failed_jobs')
        {
            DB::table('failed_jobs')->delete();
            $this->emitNotify('رویداد های ناموفق با موفقیت پاک سازی شد');
        }
    }

    public function workSingle($id)
    {
        $this->authorizing('edit_events');
        Artisan::call('cache:clear');
        Artisan::call("queue:work --queue=$id --stop-when-empty");
    }

    public function deleteSingle($id,$table)
    {
        $this->authorizing('delete_events');
        if ($table == 'job') {
            DB::table('jobs')->where('queue',$id)->delete();
            $this->emitNotify('رویداد های اماده با موفقیت پاک سازی شد');
        } elseif ($table == 'failed_job') {
            DB::table('failed_jobs')->where('queue',$id)->delete();
            $this->emitNotify('رویداد های ناموفق با موفقیت پاک سازی شد');
        }
    }

    public function retrySingle($id)
    {
        $this->authorizing('edit_events');
        Artisan::call("queue:retry --queue=$id");
        $this->emitNotify('رویداد ها اماده اجرا');
    }
}

