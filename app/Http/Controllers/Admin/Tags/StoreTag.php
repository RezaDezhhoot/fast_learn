<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TagRepositoryInterface;

class StoreTag extends BaseComponent
{
    public $header , $name ;
    public object $tag;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->tagRepository = app(TagRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_tags');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->tag = $this->tagRepository->find($id);
            $this->name = $this->tag->name;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'تگ جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_tags');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->tag);
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->tagRepository->newTagObject());
            $this->reset(['name']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate(['name'=> ['required','string','max:150','unique:tags,name,'.($this->tag->id ?? 0)]
        ],[],['name' => 'عنوان']);
        $model->name = $this->name;
        $this->tagRepository->save($model);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.tags.store-tag')->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_tags');
        $this->tagRepository->delete($this->tag);
        return redirect()->route('admin.tag');
    }
}
