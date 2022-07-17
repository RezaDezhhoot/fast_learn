<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class StoreCategory extends BaseComponent
{
    public object $category;
    public $header , $slug , $title  , $image  , $seo_keywords , $seo_description , $type ;
    public $parent_id;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_categories');
        $this->set_mode($action);
        $list = '';
        if ($this->mode == self::UPDATE_MODE) {
            $this->category = $this->categoryRepository->find($id);
            $list = $this->category->type;
            $this->header = $this->category->title;
            $this->slug = $this->category->slug;
            $this->title = $this->category->title;
            $this->type = $this->category->type;
            $this->image = $this->category->image;
            $this->parent_id = $this->category->parent_id == 0 ? null : $this->category->parent_id;
            $this->seo_keywords = $this->category->seo_keywords;
            $this->seo_description = $this->category->seo_description;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'دسته جدید';
        } else abort(404);
        $this->data['type'] = CategoryEnum::getTypes();
    }

    public function store()
    {
        $this->authorizing('edit_categories');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->category);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->categoryRepository->newCategoryObject());
            $this->reset(['slug','title','image','type','seo_keywords','seo_description','parent_id']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->parent_id = $this->emptyToNull($this->parent_id);
        $fields = [
            'title' => ['required','string','max:70'],
            'image' => ['required','string','max:250'],
            'parent_id' => ['nullable','exists:categories,id'],
            'seo_keywords' => ['required','string','max:250'],
            'seo_description' => ['required','string','max:250'],
            'type' => ['required','in:'.implode(',',array_keys(CategoryEnum::getTypes()))],
        ];
        $messages = [
            'title' => 'عنوان',
            'image' => 'ایکون',
            'seo_keywords' => 'کلمات کلیدی',
            'seo_description' => 'توضیحات سئو',
            'parent_id' => 'دسته مادر',
            'type' => 'نوع ',
        ];
        $this->validate($fields,[],$messages);
        $model->title = $this->title;
        $model->image = $this->image;
        $model->seo_keywords = $this->seo_keywords;
        $model->seo_description = $this->seo_description;
        $model->parent_id = $this->emptyToNull($this->parent_id);
        $model->type = $this->type;
        $this->categoryRepository->save($model);
        $this->data['category'][$model->id] = $model->title;
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        if ($this->mode == self::UPDATE_MODE) {
            $this->data['category'] = $this->categoryRepository->getAll($this->type,[['id','!=',$this->category->id]])->pluck('title','id');
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->data['category'] = $this->categoryRepository->getAll($this->type)->pluck('title','id');
        }
        return view('admin.categories.store-category')->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_categories');
        $category = $this->categoryRepository->find($this->category->id);
        $category->delete($category);
        return redirect()->route('admin.category');
    }
}
