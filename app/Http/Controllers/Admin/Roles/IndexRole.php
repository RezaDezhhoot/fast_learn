<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Livewire\WithPagination;

class IndexRole extends BaseComponent
{
    use WithPagination ;
    public ?string $placeholder = 'عنوان';
    public function render(RoleRepositoryInterface $roleRepository)
    {
        $this->authorizing('show_roles');
        $roles = $roleRepository->getAllAdminList($this->search , $this->per_page);
        return view('admin.roles.index-role',['roles' => $roles])->extends('admin.layouts.admin');
    }
}
