<?php

namespace App\Repositories\Classes;

use App\Repositories\Interfaces\OtpRepositoryInterface;

class OtpRepository implements OtpRepositoryInterface
{
    public $otp , $user;

    public function save($user, $code)
    {
        $this->otp = $code;
        $this->user = $user;
        return $this->MySQL();
    }

    public function MySQL()
    {
        $this->user->otp = $this->otp;
        $this->user->save();
        return $this->user;
    }
}
