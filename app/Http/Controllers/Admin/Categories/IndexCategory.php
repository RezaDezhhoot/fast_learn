<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Livewire\WithPagination;

class IndexCategory extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['type'];
    public ?string $type = null , $placeholder = 'عنوان یا نام مستعار';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['type'] = CategoryEnum::getTypes();
    }

    public function render()
    {
        $this->authorizing('show_categories');
        $categories = $this->categoryRepository->getAllAdminList($this->search,$this->type,$this->per_page);
        return view('admin.categories.index-category',['categories'=>$categories])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_categories');
        $category = $this->categoryRepository->find($id);
        $category->delete($category);
    }
}
