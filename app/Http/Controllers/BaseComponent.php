<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SendRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Filesystem\Filesystem;
use Morilog\Jalali\Jalalian;

class BaseComponent extends Component
{
    use AuthorizesRequests;
    public const UPDATE_MODE = 'edit' , CREATE_MODE = 'create' , MODE_LOGIN = 'login' , REGISTER_MODE = 'register';

    protected ?Filesystem $disk;

    protected $courseRepository , $tagRepository , $categoryRepository , $quizRepository , $teacherRepository , $settingRepository ,
        $episodeRepository , $episodeTranscriptRepository , $userRepository , $articleRepository , $certificateRepository , $commentRepository , $orderRepository,
        $orderDetailRepository , $paymentReporitory , $questionRepository , $eventRepository , $notificationRepository , $transcriptRepository ,
        $choiceRepository , $reductionRepository , $reductionMetaRepository , $roleRepository , $permissionRepository , $ticketRepository ,
        $sendRepository , $userDetailRepository , $orderNoteRepository , $homeworkRepository , $contactUsRepository , $logRepository ,
        $sampleRepository , $storageRepository , $teacherRequestRepository , $storagePermissionRepository , $newCoursesRepository , $incomingMethodRepository ,
        $bankAccountsRepository , $checkoutRepository;

    public  $mode = '' , $search = '';

    public int $per_page = 10;

    public array $data = [] , $page_address = [];

    public ?SendRepositoryInterface $send;

    protected function set_mode($mode)
    {
        $this->mode = $mode;
    }

    protected function authorizing($ability)
    {
        try {
            $this->authorize($ability);
        } catch (AuthorizationException $e) {
            abort(403);
        }
    }

    protected function emitNotify($title, $icon = 'success'): \Livewire\Event
    {
        $data['title'] = $title;
        $data['icon'] = $icon;

        return $this->emit('notify', $data);
    }

    protected function emitShowModal($id)
    {
        $this->emit('showModal', $id);
    }

    protected function emitHideModal($id)
    {
        $this->emit('hideModal', $id);
    }

    public function emptyToNull($value)
    {
        if (empty($value) && $value != 0)
            return null;

        return $value;
    }

    public function dateConverter($date,$mode = 'j')
    {
        if (!empty($date)) {
            return $mode == 'j' ? Jalalian::fromDateTime(Carbon::make($date))->format('Y-m-d')
                : Jalalian::fromFormat('Y-m-d', $this->convert2english($date))->toCarbon()->format('Y-m-d');
        }
        return null;
    }

    public function convert2english($string) {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }
}
