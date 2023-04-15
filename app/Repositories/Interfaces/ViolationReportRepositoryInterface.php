<?php

namespace App\Repositories\Interfaces;

interface ViolationReportRepositoryInterface
{
    public function getAllAdmin($course , $status , $search, $perPage);

    public function checked($id);

    public function destroy($id);

    public static function getNew();
}
