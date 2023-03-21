<?php

namespace App\Http\Controllers\Site\Courses;

use App\Enums\CommentEnum;
use App\Enums\OrderEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Cart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SingleCourse extends BaseComponent
{
    use WithFileUploads , AuthorizesRequests;
    public  $course;
    public  $related_courses = [] , $comments = [] , $recaptcha , $episodes = [] , $user , $commentCount = 10 , $actionComment  , $actionLabel = 'دیدگاه جدید';
    public ?string $api_bucket = null , $local_video , $comment = null;

    private $homework ;

    public $episode  , $has_samples = false , $chapters = [] , $show_homework_form = false , $time_lapse;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
        $this->disk = getDisk(1);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount($slug)
    {
        $this->course = $this->courseRepository->get('slug',$slug,true);
        SEOMeta::setTitle($this->course->title);
        SEOMeta::setDescription($this->course->seo_description);
        SEOMeta::addKeyword($this->course->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->course->title);
        OpenGraph::setDescription($this->course->seo_description);
        TwitterCard::setTitle($this->course->title);
        TwitterCard::setDescription($this->course->seo_description);
        JsonLd::setTitle($this->course->title);
        JsonLd::setDescription($this->course->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->user = auth()->user();
        if (!is_null($this->course->samples))
            $this->has_samples = sizeof($this->course->samples) > 0;
    }

    public function loadCourse()
    {
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => route('courses') , 'label' => 'دوره های اموزشی'],
            'category' => ['link' => route('courses',['category' => $this->course->category->slug]) ,'label' => $this->course->category->title],
            'course' => ['link' => '' , 'label' => $this->course->title],
        ];
        $ids = array_value_recursive('id',$this->categoryRepository->find($this->course->category_id)->toArray());
        $this->related_courses = $this->courseRepository->whereIn('category_id',$ids,3,true,[['id' , '!=' , $this->course->id]]);
        $this->comments = $this->course->comments;
        $this->courseRepository->increment($this->course,1);
        $this->chapters = collect($this->course->chapters)->sortBy('view');
        $this->emit('loadRecaptcha');
        
    }

    public function render()
    {
        return view('site.courses.single-course')->extends('site.layouts.site.site');
    }

    public function addToCart()
    {
        if ($this->course->price > 0) {
            Cart::add($this->course);
            return redirect()->route('cart');
        }

    }


    public function updatedActionComment($value)
    {
        $this->actionLabel = $value != 'new' ? 'ارسال پاسخ' : 'دیدگاه جدید';
    }

    public function new_comment()
    {
        $this->validate([
            'comment' => ['required','string','max:255'],
            'recaptcha' => ['required', new ReCaptchaRule],
        ],[],[
            'comment' => 'متن',
            'recaptcha' => 'کلید امنیتی'
        ]);
        if (!auth()->check())
            return $this->addError('comment','لطفا ابتدا ثبت نام کنید');

        $status = CommentEnum::NOT_CONFIRMED;
        if (!is_null($this->course->teacher) && $this->course->teacher->user->id == Auth::id()) {
            $status = CommentEnum::CONFIRMED;
        }
        $data = [
            'user_id' => auth()->id(),
            'content' => $this->comment,
            'parent_id'=> $this->actionComment ?? null,
            'status' => $status
        ];
        $this->courseRepository->newComment($this->course,$data);
        $this->emit('resetReCaptcha');
        $this->reset(['comment','actionLabel','actionComment','recaptcha']);
        if (!is_null($this->course->teacher) && $this->course->teacher->user->id == Auth::id())
            return $this->emitNotify(' دیدگاه با موفقیت ثبت شد');
        return $this->emitNotify(' دیدگاه با موفقیت ثبت شد پس از تایید نمایش داده خواهد شد');
    }

    public function moreComment()
    {
        $this->commentCount = $this->commentCount + 10;
    }

    public function getFreeOrder() {
        if (Auth::check()) {
            if ($this->course->price == 0 && !$this->user->hasCourse($this->course->id)) {
                $this->courseRepository->setCourseToOrder($this->course);
                $this->emitNotify('شما با موفقیت در این دوره ثبت نام شدید.');
            }
        } else {
            return redirect()->route('auth');
        }
    }


}
