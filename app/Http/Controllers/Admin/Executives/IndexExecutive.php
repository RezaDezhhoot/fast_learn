<?php

namespace App\Http\Controllers\Admin\Executives;

use App\Repositories\Interfaces\ExecutiveRepositoryInterface;
use App\Http\Controllers\BaseComponent;
use Livewire\WithPagination;

class IndexExecutive extends BaseComponent
{
    use WithPagination;

    public  $pagination , $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->executiveRepository = app(ExecutiveRepositoryInterface::class);
    }


    public function render()
    {
        $this->authorizing('show_executives');
        $executives = $this->executiveRepository->getAllAdmin($this->search,$this->per_page);
        return view('admin.executives.index-executive',['executives'=>$executives])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_executives');
        $this->executiveRepository->destroy($id);
    }
}
