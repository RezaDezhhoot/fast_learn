<?php

namespace App\Repositories\Interfaces;


use App\Models\BankAccount;

interface BankAccountRepositoryInterface
{
    public function getAllAdmin($search , $status , $per_page);

    public function find($id , array $where = []);

    public function findOrFail($id , array $where = []);

    public function destroy($id , array $where = []);

    public function save(BankAccount $bankAccount);

    public function getAllTeacher($search , $status , $per_page);

    public function getNewObject();

    public static function getNew();
}
