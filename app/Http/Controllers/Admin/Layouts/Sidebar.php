<?php

namespace App\Http\Controllers\Admin\Layouts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ViolationReportRepositoryInterface;

class Sidebar extends BaseComponent
{
    public function render
    (
        TicketRepositoryInterface $ticketRepository , CommentRepositoryInterface $commentRepository,
        UserRepositoryInterface $userRepository , SettingRepositoryInterface $settingRepository ,
        ContactUsRepositoryInterface $contactUsRepository , TeacherRequestRepositoryInterface $teacherRequestRepository,
        NewCourseRepositoryInterface $newCourseRepository , EpisodeTranscriptRepositoryInterface $episodeTranscriptRepository,
        BankAccountRepositoryInterface $bankAccountRepository , TeacherCheckoutRepositoryInterface $checkoutRepository , ChapterTranscriptRepositoryInterface $chapterTranscriptRepository ,
        ViolationReportRepositoryInterface $violationReportRepository , FormRepositoryInterface $formRepository
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
            'chapter_transcripts' => $chapterTranscriptRepository::getNew(),
            'bank_accounts' => $bankAccountRepository::getNew(),
            'checkouts' => $checkoutRepository::getNew(),
            'violations' => $violationReportRepository::getNew(),
            'forms' => $formRepository::newItems()
        ];
        return view('admin.layouts.sidebar',$data);
    }
}
