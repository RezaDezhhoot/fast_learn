<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class Sidebar extends BaseComponent
{
    public function render
    (
        TicketRepositoryInterface $ticketRepository , CommentRepositoryInterface $commentRepository,
        UserRepositoryInterface $userRepository , SettingRepositoryInterface $settingRepository ,
        ContactUsRepositoryInterface $contactUsRepository , TeacherRequestRepositoryInterface $teacherRequestRepository,
        NewCourseRepositoryInterface $newCourseRepository , EpisodeTranscriptRepositoryInterface $episodeTranscriptRepository,
        BankAccountRepositoryInterface $bankAccountRepository , TeacherCheckoutRepositoryInterface $checkoutRepository
    )
    {
        $data = [
            'tickets' => $ticketRepository::getNew(),
            'comments' => $commentRepository::getNew(),
            'users' => $userRepository::getNew(),
            'contacts' => $contactUsRepository->get_new_items(),
            'new_teachers' => $teacherRequestRepository::getNew(),
            'new_courses' => $newCourseRepository::getNew(),
            'episode_transcripts' => $episodeTranscriptRepository::getNew(),
            'bank_accounts' => $bankAccountRepository::getNew(),
            'checkouts' => $checkoutRepository::getNew()
        ];
        return view('admin.layouts.sidebar',$data);
    }
}
