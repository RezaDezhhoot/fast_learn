<?php


namespace App\Repositories\Interfaces;


use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll($list = null , array $where = []);

    public function getAllAdminList($search , $type , $pagination);

    public function find($id);

    public function delete(Category $category);

    public function newCategoryObject();

    public function save(Category $category);

    public function count();

    public function findMany(array $ids);

    public function get(array $where = [], $get = 'get');

    public static function observe();

    public function getCategoriesWithTheirSubCategories($list = null , array $where = []);

}
