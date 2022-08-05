<?php

namespace App\Http\Controllers\Admin\Organizations;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;

class StoreOrganization extends BaseComponent
{
    public $organization , $title , $logo , $child = [] , $header;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organizationRepository = app(OrganizationRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_organizations');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->organization = $this->organizationRepository->findOrFail($id);
            $this->header = $this->organization->title;
            $this->title = $this->organization->title;
            $this->logo = $this->organization->logo;
            $this->child = $this->organization->child->toArray();
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'سازمان جدید';
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_organizations');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->organization);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->organizationRepository->newOrganizationObject());
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
        $model = $this->organizationRepository->save($model);


        foreach ($this->child as $key => $value) {
            $child = $value['id'] == 0 ?
                $this->organizationRepository->newOrganizationObject() :
                $this->organizationRepository->findOrFail($value['id'] , parent:false) ;

            $child->title = $value['title'];
            $child->logo = '';
            $child->parent_id = $model->id;
            $this->child[$key] = $this->organizationRepository->save($child);
        }
        $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_organizations');
        $this->organizationRepository->destroy($this->organization->id);
        return redirect()->route('admin.organization');

    }

    public function addChild()
    {
        $this->child[] = ['title' => '' , 'id' => 0];
    }

    public function deleteChild($key)
    {
        $this->authorizing('delete_organizations');
        if ($this->child[$key]['id'] == 0) {
            unset($this->child[$key]);
        } else {
            $this->organizationRepository->destroy($this->child[$key]['id']);
            unset($this->child[$key]);
        }
        
        $this->emitNotify('سازمان مورد نظر با موفقیت حذف شد');
    }

    public function render()
    {
        return view('admin.organizations.store-organization')->extends('admin.layouts.admin');
    }
}
