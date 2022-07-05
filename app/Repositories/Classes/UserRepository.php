<?php


namespace App\Repositories\Classes;

use App\Models\Certificate;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function searchUsers($select , $where = [] , $orWhere = [])
    {
        return User::latest('id')->select($select)->where($where)->orWhere($orWhere)->cursor();
    }

    public function walletTransactions(User $user)
    {
        // TODO: Implement walletTransactions() method.
        return $user->walletTransactions()->where('confirmed', 1)->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function syncRoles(User $user ,$roles)
    {
        return $user->syncRoles($roles);
    }

    public function getUser($col, $value)
    {
        return User::where($col,$value)->firstOrFail();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    /**
     * @return mixed
     */
    public static function getNew()
    {
        return User::getNew();
    }

    public function getAll()
    {
        return User::all();
    }

    public function save(User $user)
    {
        $user->save();
        return $user;
    }

    public function getAllAdminList($status, $roles, $search, $pagination)
    {
        return User::latest('id')->when($status, function ($query) use ($status) {
            return $query->where('status' , $status);
        })->when($roles, function ($query) use ($roles) {
            return $query->role($roles);
        })->search($search)->paginate($pagination);
    }

    public function newUserObject()
    {
        // TODO: Implement newUserObject() method.
        return new User();
    }

    public function hasRole($role)
    {
        return auth()->user()->hasRole($role);
    }

    public function submit_certificate(User $user, $certificate_id,$transcript_id)
    {
        return $user->certificates()->updateOrCreate(['certificate_id'=>$certificate_id,'transcript_id'=>$transcript_id],[]);
    }

    public function reclaiming_certificate(User $user, $certificate_id,$transcript_id)
    {
        $user->certificates()->where([['certificate_id',$certificate_id],['transcript_id',$transcript_id]])->delete();
    }

    public function has_certificate(User $user, $certificate_id , $transcript_id)
    {
        return $user->certificates()->where([['certificate_id',$certificate_id],['transcript_id',$transcript_id]])->first();
    }

    public function findCertificate(User $user, $id,$status)
    {
        return $status == 'demo' ?
            $user->certificates()->findOrFail($id) :
            $user->certificates()->where('transcript_id','!=',0)->findOrFail($id);
    }

    public function findBy($where = [])
    {
        return User::where($where)->firstOrFail();
    }

    public function getDashboardData($from_date , $to_date)
    {
        return User::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->count();
    }

    public function count()
    {
        return User::count();
    }
}
