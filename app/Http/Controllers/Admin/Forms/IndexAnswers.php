<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Enums\FormEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\FormRepositoryInterface;
use Livewire\WithPagination;

class IndexAnswers extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['subject'];

    public $subject , $placeholder = 'عنوان فرم یا اطلاعات کاربر';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->formReposirtory = app(FormRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_forms');
        $this->data['subject'] = FormEnum::getSubjects();
    }

    public function render()
    {
        $items = $this->formReposirtory->answerGetAllAdmin($this->subject,$this->search,$this->per_page );
        return view('admin.forms.index-answers',get_defined_vars())->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_forms');
        $this->formReposirtory->answerDestroy($id);
    }
}
