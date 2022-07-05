<?php


namespace App\Repositories\Interfaces;


use App\Models\Setting;

interface SettingRepositoryInterface
{
    public function getRow($name , $default = null);

    public function getSubjects($name , $default = []);

    public function getFagList();

    public static function getProvince();

    public static function getCity($province);

    public static function getCities();

    public static function updateOrCreate(array $key , array $value);

    public function find($id);

    public function delete(Setting $setting);

    public function newSettingObject();

    public function save(Setting $setting);

    public function getAdminFag($name);

    public function codes();

    public function getAdminLaw($name);

    public static function models();

    public static function variables();
}
