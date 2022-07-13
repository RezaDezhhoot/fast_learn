<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\SendRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Contracts\Filesystem\Filesystem;

class BaseComponent extends Component
{
    use AuthorizesRequests;
    public const UPDATE_MODE = 'edit' , CREATE_MODE = 'create' , MODE_LOGIN = 'login' , REGISTER_MODE = 'register';

    protected ?Filesystem $disk;

    protected $courseRepository , $tagRepository , $categoryRepository , $quizRepository , $teacherRepository , $settingRepository ,
        $episodeRepository , $userRepository , $articleRepository , $certificateRepository , $commentRepository , $orderRepository,
        $orderDetailRepository , $paymentReporitory , $questionRepository , $eventRepository , $notificationRepository , $transcriptRepository ,
        $choiceRepository , $reductionRepository , $reductionMetaRepository , $roleRepository , $permissionRepository , $ticketRepository ,
        $sendRepository , $userDetailRepository , $orderNoteRepository , $homeworkRepository;

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
        if (empty($value))
            return null;

        return $value;
    }
}
