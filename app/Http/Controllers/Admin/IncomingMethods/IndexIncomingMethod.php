<?php

namespace App\Http\Controllers\Admin\IncomingMethods;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\IncomingMethodRepositoryInterface;
use Livewire\WithPagination;

class IndexIncomingMethod extends BaseComponent
{
    use WithPagination;

    public $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->incomingMethodRepository = app(IncomingMethodRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_incoming_methods');
    }

    public function render()
    {
        $methods = $this->incomingMethodRepository->getAllAdmin($this->search , $this->per_page);
        return view('admin.incoming-methods.index-incoming-method',['methods'=>$methods])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_incoming_methods');
        $this->incomingMethodRepository->destroy($id);
    }
}
