<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class StoreFag extends BaseComponent
{
    public $header , $row , $question  , $answer , $order , $category;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_settings_fag');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->row = $this->settingRepository->find($id);
            $this->question = $this->row->value['question'];
            $this->answer = $this->row->value['answer'];
            $this->order = $this->row->value['order'];
            $this->category = $this->row->value['category'];
        }
        $this->header = 'سوال';
    }

    public function store()
    {
        $this->authorizing('edit_settings_fag');
        if ($this->mode == 'edit')
            $this->saveInDataBase($this->row);
        elseif ($this->mode == 'create'){
            $this->saveInDataBase($this->settingRepository->newSettingObject());
            $this->reset(['question','answer','category','order']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'question' => ['required','string','max:1000'],
            'answer' => ['required','string','max:1000'],
            'category' => ['required','string','max:250'],
            'order' => ['required','integer','between:0,10000000000']
        ],[],[
            'question' => 'سوال',
            'answer' => 'جواب',
            'category' => 'دسته',
            'order'=> 'نمایش',
        ]);
        $model->name = 'question';
        $model->value = json_encode(['question' => $this->question,'answer' => $this->answer,'category' => $this->category , 'order' => $this->order]);
        $this->settingRepository->save($model);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteItem()
    {
        $this->authorizing('edit_settings_fag');
        $this->settingRepository->delete($this->question);
        return redirect()->route('admin.setting.law');
    }

    public function render()
    {
        return view('admin.settings.store-fag')
            ->extends('admin.layouts.admin');
    }
}
