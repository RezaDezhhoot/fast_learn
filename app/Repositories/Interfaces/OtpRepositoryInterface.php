<?php

namespace App\Repositories\Interfaces;

interface OtpRepositoryInterface
{
    public function save($user , $code);

    public function MySQL();
}
