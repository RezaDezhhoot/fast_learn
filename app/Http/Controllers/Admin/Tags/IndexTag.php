<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Livewire\WithPagination;

class IndexTag extends BaseComponent
{
    use WithPagination;
    public string $placeholder = 'نام تگ';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->tagRepository = app(TagRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_tags');
        $tags = $this->tagRepository->getAllAdmin($this->search,$this->per_page);
        return view('admin.tags.index-tag',['tags' => $tags])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_tags');
        $this->tagRepository->destroy($id);
    }
}
