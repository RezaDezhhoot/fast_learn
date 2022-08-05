<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use Livewire\WithPagination;

class IndexOrganization extends BaseComponent
{
    use WithPagination;
    
    public  $pagination , $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organizationRepository = app(OrganizationRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_organizations');
        $organizations = $this->organizationRepository->getAllAdmin($this->search,$this->per_page);
        return view('admin.organizations.index-organization',['organizations'=>$organizations])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_organizations');
        $this->organizationRepository->destroy($id);
    }
}
