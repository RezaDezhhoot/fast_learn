<?php

namespace App\Http\Controllers\Admin\Forms;

use App\Enums\FormEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\FormRepositoryInterface;

class StoreAnswers extends BaseComponent
{
    public $formModel , $header , $storage;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->formReposirtory = app(FormRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('edit_forms');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->formModel = $this->formReposirtory->answerFindOrFail($id);
            $this->storage = $this->formModel->storage;
            $this->header = $this->formModel->form_details['form_title'];
            $this->formReposirtory->answerUpdate([
                'status' => true,
            ],$this->formModel);
        } else abort(404);

        $this->data['subject'] = FormEnum::getSubjects();
        $this->data['storage'] = getAvailableStorages();
    }

    public function deleteItem()
    {
        $this->authorizing('delete_forms');
        $this->formReposirtory->answerDestroy($this->formModel->id);
        return redirect()->route('admin.answer');
    }

    public function render()
    {
        return view('admin.forms.store-answers')->extends('admin.layouts.admin');
    }

    public function download($key)
    {
        $item = $this->formModel->form_data[$key];
        $disk = getDisk($this->formModel->storage);
        if ($disk->exists($item['value'])){
            return $disk->download($item['value']);
        }
    }
}
