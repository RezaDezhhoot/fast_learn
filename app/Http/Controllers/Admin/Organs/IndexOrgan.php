<?php

namespace App\Http\Controllers\Admin\Organs;

use App\Enums\OrganEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use Livewire\WithPagination;

class IndexOrgan extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['status','new_info'];

    public $status, $new_info , $user , $placeholder = 'عنوان ارگان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organRepository = app(OrganRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_organs');
        $this->data['status'] = OrganEnum::getStatus();
        $this->data['new_info'] = [
            1 => 'بدون تغییر',
            0 => 'جدید'
        ];
    }

    public function render()
    {
        $items = $this->organRepository->getAllAdmin($this->status,$this->user,$this->search,$this->new_info,$this->per_page);
        return view('admin.organs.index-organ',get_defined_vars())
            ->extends('admin.layouts.admin');
    }
}
