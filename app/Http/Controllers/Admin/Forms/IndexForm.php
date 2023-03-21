<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Enums\FormEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\FormRepositoryInterface;
use Livewire\WithPagination;

class IndexForm extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['type'];

    public $type , $placeholder = 'عنوان فرم';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->formReposirtory = app(FormRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_forms');
        $this->data['type'] = FormEnum::getSubjects();
    }

    public function render()
    {
        $forms = $this->formReposirtory->getAllAdmin($this->type , $this->search,$this->per_page);
        return view('admin.forms.index-form',get_defined_vars())->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_forms');
        $this->formReposirtory->destroy($id);
    }
}
