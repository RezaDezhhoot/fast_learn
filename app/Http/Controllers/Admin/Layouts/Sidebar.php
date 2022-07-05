<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class Sidebar extends BaseComponent
{
    public function render
    (
        TicketRepositoryInterface $ticketRepository , CommentRepositoryInterface $commentRepository,
        UserRepositoryInterface $userRepository , SettingRepositoryInterface $settingRepository
    )
    {
        $data = [
            'tickets' => $ticketRepository::getNew(),
            'comments' => $commentRepository::getNew(),
            'users' => $userRepository::getNew(),
            'logo' => $settingRepository->getRow('logo')
        ];
        return view('admin.layouts.sidebar',$data);
    }
}
