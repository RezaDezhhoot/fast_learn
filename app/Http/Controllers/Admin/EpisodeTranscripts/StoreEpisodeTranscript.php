<?php

namespace App\Http\Controllers\Admin\EpisodeTranscripts;

use App\Enums\EpisodeEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;

class StoreEpisodeTranscript extends BaseComponent
{
    public  $header  , $episode , $status , $message , $is_confirmed , $free , $description;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeTranscriptRepository = app(EpisodeTranscriptRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('show_episodes');
        $this->set_mode($action);
        $this->data['status'] = EpisodeEnum::getStatus();
        if ($this->mode == self::UPDATE_MODE) {
            $this->episode = $this->episodeTranscriptRepository->findOrFail($id);
            $this->header = " درس {$this->episode->title} از {$this->episode->course->title} ";
            $this->status =  $this->episode->status;
            $this->message =  $this->episode->message;
            $this->is_confirmed =  $this->episode->is_confirmed;
            $this->description =  $this->episode->description;
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_episodes');
        $this->saveInDataBase($this->episode);
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'status' => ['required','in:'.implode(',',array_keys(EpisodeEnum::getStatus()))],
            'message' => ['required','string','max:100000'],
            'free' => ['boolean'],
        ],[],[
            'status' => 'وضعیت',
            'message' => 'نتیجه نهایی',
            'free' => 'رایگان',
        ]);
        $model->status = $this->status;
        $model->message = $this->message;
        $message = 'اطلاعات با موفقیت ذخیره شد';
        if ($model->isDirty('status') && $this->status == EpisodeEnum::CONFIRMED_STATUS && ! $this->is_confirmed) {
            $model->free = $this->free;
            $this->episode->free = $this->free;
            $episode = !is_null($this->episode->episode) ? $this->episode->episode : $this->episodeRepository->newEpisodeObject();
            $this->episodeRepository->save(
                $this->episodeTranscriptRepository->confirmThisTranscript($this->episode , $episode)
            );
            $model->is_confirmed = true;
            $this->is_confirmed = true;
            $message = 'رونوشت با موفقیت اعمال شد';
        }
        $this->episodeTranscriptRepository->save($model);
        $this->emitNotify($message);
    }

    public function deleteItem()
    {
        $this->authorizing('delete_episodes');
        $this->episodeTranscriptRepository->destroy($this->episode->id);
        return redirect()->route('admin.episodeTranscript');
    }

    public function render()
    {
        return view('admin.episode-transcripts.store-episode-transcript')
            ->extends('admin.layouts.admin');
    }

    public function download($address , $media)
    {
        $this->authorizing('edit_episodes');
        if ($media == 'file' && !is_null($this->episode->file_storage)) {
            $disk = getDisk($this->episode->file_storage);
            if ($disk->exists($address))
                return $disk->download($address);
            else $this->emitNotify('خطا در خنگام دانلود فایل','warning');
        } elseif ($media == 'video' && !is_null($this->episode->video_storage)) {
            $disk = getDisk($this->episode->video_storage);
            if ($disk->exists($address))
                return $disk->download($address);
            else $this->emitNotify('خطا در خنگام دانلود ویدئو','warning');
        }
    }
}
