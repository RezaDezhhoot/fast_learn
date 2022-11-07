<?php

namespace App\Repositories\Interfaces;


use App\Models\TeacherCheckout;

interface TeacherCheckoutRepositoryInterface
{
    public function getAllAdmin($search , $status , $per_page);

    public function destroy($id);

    public function save(TeacherCheckout $checkout);

    public function getAllTeacher($search,$status , $per_page);

    public function getNewObject();

    public static function getNew();

    public function findOrFail($id , $where = []);


}
