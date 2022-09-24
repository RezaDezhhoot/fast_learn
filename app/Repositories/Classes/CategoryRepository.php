<?php


namespace App\Repositories\Classes;


use App\Enums\CategoryEnum;
use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository  implements CategoryRepositoryInterface
{
    /**
     * @param string $list
     * @return mixed
     */
    public function getAll($list = null , array $where = [])
    {
        return match ($list) {
            CategoryEnum::ARTICLE => Category::article()->with(['childrenRecursive'])->where($where)->get(),
            CategoryEnum::COURSE => Category::course()->with(['childrenRecursive'])->where($where)->get(),
            CategoryEnum::QUESTION => Category::question()->with(['childrenRecursive'])->where($where)->get(),
            default => Category::all(),
        };
    }

    public function getCategoriesWithTheirSubCategories($list = null , array $where = [])
    {
        $categories = $this->getAll($list,$where);
        foreach ($categories as $item){
            $item->sub_categories = array_value_recursive('slug',$item->childrenRecursive->toArray());
            $item->sub_categories_title = array_value_recursive('title',$item->childrenRecursive->toArray());
        }

        return $categories->toArray();
    }

    /**
     * @param $search
     * @param $type
     * @param $pagination
     * @return mixed
     */
    public function getAllAdminList($search, $type, $pagination)
    {
        return Category::latest('id')->when($type,function ($query) use ($type){
            return $query->where('type',$type);
        })->search($search)->paginate($pagination);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function newCategoryObject()
    {
        return new Category();
    }

    public function save(Category $category)
    {
        $category->save();
        return $category;
    }

    public function count()
    {
        return Category::count();
    }

    public function findMany(array $ids)
    {
        return Category::findMany($ids);
    }

    public function get(array $where = [] , $get = 'get')
    {
        $model = Category::latest('id')->with(['childrenRecursive'])->where($where);
        return $get == 'get' ? $model->get() : $model->first();
    }

    public static function observe()
    {
        Category::observe(CategoryObserver::class);
    }
}
