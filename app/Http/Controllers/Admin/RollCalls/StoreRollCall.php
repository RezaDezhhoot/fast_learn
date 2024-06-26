<?php

namespace App\Http\Controllers\Admin\RollCalls;

use App\Enums\RollCallEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\OrderDetailRepository;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Livewire\WithPagination;

class StoreRollCall extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['chapter'];

    public  $header , $course , $chapter , $status = [] , $placeholder = 'اطلاعات دانش اموز';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepository::class);
    }

    public function mount($id)
    {
        $this->authorizing('show_roll_calls');
        $this->course = $this->courseRepository->find($id);
        $this->course->load(['details' => function($q) {
            return $q->paid();
        },'details.order','details.order.user','rollCalls']);
        $this->header ='لیست حضور غیاب دوره '. $this->course->title;

        $this->data['chapter'] = $this->chapterRepository->alL('course',$id,'id')->pluck('title','id');
        $this->data['status'] = RollCallEnum::getStatus();
    }

    public function render()
    {
        $lists = $this->episodeRepository->getAllAdmin($this->course->id,$this->chapter ?? -10,null,null);
        $details = $this->orderDetailRepository->getAllByCourse($this->course,$this->search,$this->per_page);
        $this->loadCalls($details);
        return view('admin.roll-calls.store-roll-call',get_defined_vars())
            ->extends('admin.layouts.admin');

    }

    public function loadCalls($details)
    {
        foreach ($details as $detail) {
            foreach ($detail->rollCalls as $call) {
                $this->status[$call->order_detail_id][$call->episode_id][$call->user_id] = [
                    'value' => $call->order_detail_id.'.'.$call->episode_id.'.'.$call->user_id.'.'.$call->status,
                    'date' => $call->last_date
                ];
            }
        }
    }

    public function updatedChapter()
    {
        $this->resetPage();
    }


    public function updatedStatus($value)
    {
        $value = explode('.',$value);
        $this->episodeRepository->submitRollCall($value[1],$value[0],$value[2],$value[3]);
    }
}
