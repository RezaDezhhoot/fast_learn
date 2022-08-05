<?php

namespace App\Http\Controllers\Admin\Executives;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;

class StoreExecutive extends BaseComponent
{
    public $executive , $title , $logo , $child = [] , $header;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->executiveRepository = app(ExecutiveRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_executives');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->executive = $this->executiveRepository->findOrFail($id);
            $this->header = $this->executive->title;
            $this->title = $this->executive->title;
            $this->logo = $this->executive->logo;
            $this->child = $this->executive->child->toArray();
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'دستگاه اجرایی جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_executives');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->executive);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->executiveRepository->newExecutiveObject());
            $this->reset(['title','child','logo']);
        }
    }

    public function saveInDatabase($model)
    {
        $this->validate([
            'title' => ['string','required','max:255'],
            'logo' => ['required','string','max:7000'],
            'child' => ['array','min:0','max:15'],
            'child.*.title' => ['string','required','max:255']
        ],[],[
            'title' => 'عنوان',
            'logo' => 'لوگو',
            'title' => 'زیر مجموعه ها',
            'child.*.title' => 'عنوان',
        ]);
        
        $model->title = $this->title;
        $model->logo = $this->logo;
        $model->parent_id = null;
        $model = $this->executiveRepository->save($model);


        foreach ($this->child as $key => $value) {
            $child = $value['id'] == 0 ?
                $this->executiveRepository->newexecutiveObject() :
                $this->executiveRepository->findOrFail($value['id'] , parent:false) ;

            $child->title = $value['title'];
            $child->logo = '';
            $child->parent_id = $model->id;
            $this->child[$key] = $this->executiveRepository->save($child);
        }
        $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_executives');
        $this->executiveRepository->destroy($this->executive->id);
        return redirect()->route('admin.executive');

    }

    public function addChild()
    {
        $this->child[] = ['title' => '' , 'id' => 0];
    }

    public function deleteChild($key)
    {
        $this->authorizing('delete_executives');
        if ($this->child[$key]['id'] == 0) {
            unset($this->child[$key]);
        } else {
            $this->executiveRepository->destroy($this->child[$key]['id']);
            unset($this->child[$key]);
        }
        
        $this->emitNotify('دستگاه اجرایی مورد نظر با موفقیت حذف شد');
    }

    public function render()
    {
        return view('admin.executives.store-executive')->extends('admin.layouts.admin');
    }
}
