<?php

namespace App\Http\Controllers\Admin\ChapterTranscripts;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use Illuminate\Validation\Rule;

class StoreChapterTranscript extends BaseComponent
{
    public  $header  , $chapter , $status , $message , $is_confirmed , $description , $main_status , $main_chapter;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->chapterTranscriptRepository = app(ChapterTranscriptRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('show_chapters');
        $this->set_mode($action);
        $this->data['status'] = ChapterEnum::getTranscriptStatus();
        $this->data['main_status'] = ChapterEnum::getStatus();
        if ($this->mode == self::UPDATE_MODE) {
            $this->chapter = $this->chapterTranscriptRepository->findOrFail($id);
            $this->main_chapter = $this->chapter->chapter ?? null;
            $this->header = " {$this->chapter->course->title} - {$this->chapter->title} ";
            $this->main_status = $this->chapter->chapter->status ?? null;
            $this->status =  $this->chapter->status;
            $this->message =  $this->chapter->message;
            $this->is_confirmed =  $this->chapter->is_confirmed;
            $this->description =  $this->chapter->description;
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_chapters');
        $this->saveInDataBase($this->chapter);
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'status' => ['required',Rule::in(array_keys(ChapterEnum::getTranscriptStatus()))],
            'main_status' => ['required',Rule::in(array_keys(ChapterEnum::getStatus()))],
            'message' => ['required','string','max:100000'],
        ],[],[
            'status' => 'وضعیت',
            'main_status' => 'وضعیت فصل',
            'message' => 'نتیجه نهایی',
        ]);
        $model->status = $this->status;
        $model->message = $this->message;
        $message = 'اطلاعات با موفقیت ذخیره شد';
        if ($model->isDirty('status') && $this->status == ChapterEnum::TRANSCRIPT_ACCEPTED && ! $this->is_confirmed) {
            $this->chapterRepository->save(
                $this->chapterTranscriptRepository->confirmThisTranscript($model,$this->main_status , $this->main_chapter)
            );
            $model->is_confirmed = true;
            $this->is_confirmed = true;
            $message = 'رونوشت با موفقیت اعمال شد';
        }
        $this->chapterTranscriptRepository->save($model);
        $this->emitNotify($message);
    }

    public function render()
    {
        return view('admin.chapter-transcripts.store-transcript')
            ->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_chapters');
        $this->chapterTranscriptRepository->destroy($this->chapter->id);
        return redirect()->route('admin.chapterTranscript');
    }
}
