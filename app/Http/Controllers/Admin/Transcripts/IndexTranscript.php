<?php

namespace App\Http\Controllers\Admin\Transcripts;

use App\Enums\QuizEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use Livewire\WithPagination;

class IndexTranscript extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['result'];
    public ?string $result = null , $placeholder = ' موبایل کاربر یا شماره گواهینامه یا شماره کارنامه ';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['result'] = QuizEnum::getResult();
    }

    public function render()
    {
        $this->authorizing('show_transcripts');
        $transcripts = $this->transcriptRepository->getAllAdmin($this->search,$this->result,$this->per_page);
        return view('admin.transcripts.index-transcript',['transcripts'=>$transcripts])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_transcripts');
        $this->transcriptRepository->destroy($id);
    }
}
