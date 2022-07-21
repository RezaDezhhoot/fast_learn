<?php


namespace App\Repositories\Interfaces;


use App\Models\User;

interface UserRepositoryInterface
{
    public function searchUsers($select , $where = [] , $orWhere = []);

    public function walletTransactions(User $user);

    public function create(array $data);

    public function syncRoles(User $user ,$roles);

    public function update(User $user, array $data);

    public function getAllAdminList($status , $roles , $search , $pagination);

    public function getUser($col,$value);

    public function find($id);

    public static function getNew();

    public function getAll();

    public function save(User $user);

    public function newUserObject();

    public function hasRole($role);

    public function submit_certificate(User $user , $certificate_id,$transcript_id);

    public function reclaiming_certificate(User $user , $certificate_id,$transcript_id);

    public function has_certificate(User $user , $certificate_id , $transcript_id);

    public function findCertificate(User $user , $id,$status);

    public function findBy($where = []);

    public function getDashboardData($from_date , $to_date );

    public function count();

    public function getUsersForEvent(string $orderBy , int $count);

    public function getModelNamespace(): string;
}
