<?php


namespace App\Repositories\Interfaces;


interface OrderRepositoryInterface
{
    public static function getNew();

    public function getAllAdmin($search , $status,$per_page);

    public function find($id);

    public function count(array $where = []);

    public static function CHANGE_ID();

    public function create(array $data);

    public function get(array $where);

    public function destroy($id);

    public function getNameSpace(): string;
}
