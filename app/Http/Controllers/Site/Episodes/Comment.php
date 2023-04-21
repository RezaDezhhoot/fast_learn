<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Illuminate\Support\Facades\Auth;

class Comment extends BaseComponent
{
    public  $comments = [] , $user_name , $recaptcha , $user , $commentCount = 10  , $actionComment  , $actionLabel = 'دیدگاه جدید' , $comment = null;

    public  $course_data, $epsode_data;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
    }

    public function mount($course,$episode)
    {
        $this->course_data = $course;
        $this->epsode_data = $episode;
        $this->comments = $this->epsode_data->comments;

        if (auth()->check())
            $this->user_name = auth()->user()->name;

        $this->emit('loadRecaptcha');
    }

    public function loadComments()
    {
        $this->emit('loadRecaptcha');
    }

    public function render()
    {
        return view('site.episodes.comment');
    }

    public function updatedActionComment($value)
    {
        $this->actionLabel = $value != 'new' ? 'ارسال پاسخ' : 'دیدگاه جدید';
    }

    public function new_comment()
    {
        $this->validate([
            'comment' => ['required','string','max:255'],
            'user_name' => ['nullable','string','max:255'],
        ],[],[
            'comment' => 'متن',
            'user_name' => 'نام',
        ]);
        if (!auth()->check()) {
             $this->addError('comment','لطفا ابتدا ثبت نام کنید');
            return;
        }

        if ($rateKey = rateLimiter(value:request()->ip().'_comment',max_tries: 3))
        {
            return
                $this->addError('comment', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
        }

        $status = CommentEnum::NOT_CONFIRMED;
        if (!is_null($this->course_data->teacher) && $this->course_data->teacher->user->id == Auth::id()) {
            $status = CommentEnum::CONFIRMED;
        }
        $data = [
            'user_id' => auth()->id(),
            'content' => $this->comment,
            'name' => $this->user_name,
            'parent_id'=> $this->actionComment ?? null,
            'status' => $status
        ];
        $this->episodeRepository->newComment($this->epsode_data,$data);
        $this->reset(['comment','actionLabel','actionComment','recaptcha']);

        if (!is_null($this->course_data->teacher) && $this->course_data->teacher->user->id == Auth::id()) {
            $this->emitNotify(' دیدگاه با موفقیت ثبت شد');
        } else {
            $this->emitNotify(' دیدگاه با موفقیت ثبت شد پس از تایید نمایش داده خواهد شد');
        }
    }

    public function moreComment()
    {
        $this->commentCount = $this->commentCount + 10;
    }
}
