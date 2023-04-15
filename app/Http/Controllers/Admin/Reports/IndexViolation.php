<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ViolationReportRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IndexViolation extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['course','status'];

    public $course , $status = -1 , $placeholder = 'عنوان درس';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->violationReportRepository = app(ViolationReportRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_violations');
        $this->data['status'] = [
            1 => 'بررسی شده',
            0 => 'جدید'
        ];
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function checked($id)
    {
        $this->authorizing('edit_violations');
        if ($this->violationReportRepository->checked($id)) {
            $this->emitNotify('گزارش بررسی شد');
        }
    }

    public function delete($id)
    {
        $this->authorizing('delete_violations');
        if ($this->violationReportRepository->destroy($id)) {
            $this->emitNotify('گزارش با موفقیت حذف شد');
        }
    }

    public function render()
    {
        $items = $this->violationReportRepository->getAllAdmin($this->course,$this->status,$this->search,$this->per_page);
        return view('admin.reports.index-violation',['items' => $items])
            ->extends('admin.layouts.admin');
    }
}
