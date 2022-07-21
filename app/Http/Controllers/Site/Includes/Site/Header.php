<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Enums\CategoryEnum;
use App\Helpers\Helper;
use App\Http\Controllers\BaseComponent;
use App\Http\Controllers\Cart\Facades\Cart as Carts;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Header extends BaseComponent
{
    public  $categories = [] , $cartContent = [] , $q;

    protected $queryString = ['q'];

    public function mount
    (
        SettingRepositoryInterface $settingRepository ,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $categories = $categoryRepository->getAll(CategoryEnum::COURSE,[['parent_id',null]]);
        $this->cartContent = Carts::content();

        foreach ($categories as $item){
            $item->sub_categories = array_value_recursive('slug',$item->childrenRecursive->toArray());
            $item->sub_categories_title = array_value_recursive('title',$item->childrenRecursive->toArray());

        }

        $this->categories = $categories->toArray();


    }

    public function render()
    {
        return view('site.includes.site.header');
    }

    public function search()
    {
        redirect()->route('courses',['q'=>$this->q]);
    }
}
