<?php

namespace App\Http\Controllers\Admin\IncomingMethods;

use App\Enums\IncomingMethodEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\IncomingMethodRepositoryInterface;

class StoreIncomingMethod extends BaseComponent
{
    public $header , $method , $title , $value , $expire_limit , $count_limit;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->incomingMethodRepository = app(IncomingMethodRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_incoming_methods');
        self::set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->method = $this->incomingMethodRepository->findOrFail($id);
            $this->header = $this->method->title;
            $this->title = $this->method->title;
            $this->value = $this->method->value;
            $this->expire_limit = $this->method->expire_limit;
            $this->count_limit = $this->method->count_limit;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'روش جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_incoming_methods');

        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->method);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->incomingMethodRepository->getNewObject());
            $this->reset(['method','title','value','expire_limit','count_limit']);
        }
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'title' => ['required','string','max:250'],
            'value' => ['required','numeric','between:0,100'],
            'expire_limit' => ['nullable','integer','between:1,10000000000'],
            'count_limit' => ['nullable','integer','between:1,10000000000']
        ],[],[
            'title' => 'عنوان',
            'value' => 'درصد',
            'expire_limit' => 'محدودیت زمانی',
            'count_limit' => 'محدودیت تعداد'
        ]);
        $model->title = $this->title;
        $model->type = IncomingMethodEnum::PERCENT_TYPE;
        $model->value = $this->value;
        $model->expire_limit = emptyToNull($this->expire_limit);
        $model->count_limit = emptyToNull($this->count_limit);
        $model = $this->incomingMethodRepository->save($model);
        $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('edit_incoming_methods');
        $this->incomingMethodRepository->destroy($this->method->id);
        return redirect()->route('admin.incoming');
    }

    public function render()
    {
        return view('admin.incoming-methods.store-incoming-method')
            ->extends('admin.layouts.admin');
    }
}
