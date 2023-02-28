<?php

namespace App\Http\Controllers\Admin\Events;

use App\Enums\EventEnum;
use App\Enums\JobEnum;
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

    public function start()
    {
        if (!app()->environment('local'))
        {
            if (DB::table('jobs')->where('queue',JobEnum::START_EVENT)->exists())
                return Artisan::call("queue:work --queue=".JobEnum::START_EVENT." --timeout=45 --stop-when-empty");
        }
    }


    public function render()
    {
        $this->authorizing('show_events');
        $events = $this->eventRepository->getAllAdmin($this->status , $this->search , $this->per_page);
        $failed_jobs = DB::table('failed_jobs')->whereNotIn('queue',JobEnum::getMainJobCategories())->count();
        $jobs = DB::table('jobs')->whereNotIn('queue',JobEnum::getMainJobCategories())->count();

        return view('admin.events.index-event',['events' => $events , 'failed_jobs' => $failed_jobs ,'jobs' => $jobs])
            ->extends('admin.layouts.admin');
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
            DB::table('jobs')->whereNotIn('queue',JobEnum::getMainJobCategories())->delete();
            $this->emitNotify('رویداد های اماده با موفقیت پاک سازی شد');
        } elseif ($status == 'failed_jobs')
        {
            DB::table('failed_jobs')->whereNotIn('queue',JobEnum::getMainJobCategories())->delete();
            $this->emitNotify('رویداد های ناموفق با موفقیت پاک سازی شد');
        }
    }

    public function workSingle($id)
    {
        $this->authorizing('edit_events');
        if ($id != 'start' && !app()->environment('local'))
        {
            Artisan::call('cache:clear');
            Artisan::call("queue:work --queue=$id --stop-when-empty");
            $this->emit('relaod_page');
        }
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

