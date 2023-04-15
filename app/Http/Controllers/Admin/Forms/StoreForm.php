<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Enums\FormEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Traits\Admin\FormBuilder;
use Illuminate\Validation\Rule;
use Livewire\Component;

class StoreForm extends BaseComponent
{
    use FormBuilder;

    public $formModel  , $name , $subject , $storage , $header , $status;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->formReposirtory = app(FormRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_forms');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->formModel = $this->formReposirtory->findOrFail($id);
            $this->name = $this->formModel->name;
            $this->header = $this->formModel->name;
            $this->form = $this->formModel->forms;
            $this->subject = $this->formModel->subject;
            $this->status = $this->formModel->status;
            $this->storage = $this->formModel->storage;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'فرم جدید';
        } else abort(404);
        $this->data['subject'] = FormEnum::getSubjects();
        $this->data['status'] = FormEnum::getStatus();
        $this->data['storage'] = getAvailableStorages();
    }

    public function render()
    {
        return view('admin.forms.store-form')
            ->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_forms');
        $this->formReposirtory->destroy($this->formModel->id);
        return redirect()->route('admin.form');
    }

    public function store()
    {
        $this->authorizing('edit_forms');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->formModel);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase($this->formReposirtory->getNewObject());
            $this->reset(['name','form','storage','subject']);
        }
    }

    private function saveInDateBase($model)
    {
        $this->validate([
            'name' => ['required','string','max:200'],
            'subject' => ['required','string',Rule::in(array_keys(FormEnum::getSubjects()))],
            'status' => ['required','string',Rule::in(array_keys(FormEnum::getStatus()))],
            'form' => ['nullable','array'],
            'storage' => ['nullable',Rule::in(array_keys(getAvailableStorages()))]
        ],[],[
            'name' => 'عنوان',
            'subject' => 'موضوغ',
            'form' => 'فرم ها',
            'storage' => 'فضای ذخیره سازی'
        ]);
        $model->name = $this->name;
        $model->subject = $this->subject;
        $model->forms = $this->form;
        $model->status = $this->status;
        $model->storage = $this->storage;
        $this->formReposirtory->save($model);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }
}
