<?php

namespace App\Http\Controllers\Site\Courses;

use App\Enums\OrderEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Cart\Facades\Cart;
use Illuminate\Support\Facades\Log;

class SingleCourse extends BaseComponent
{
    public  $course;
    public  $related_courses , $comments , $recaptcha , $episodes , $user , $commentCount = 10 , $actionComment = 'new' , $actionLabel = 'دیدگاه جدید';
    public ?string $api_bucket = null , $local_video , $comment = null , $episode_title = null , $episode_id;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->disk = getDisk();
    }

    public function mount($slug)
    {
        $this->course = $this->courseRepository->get('slug',$slug);
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
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => route('courses') , 'label' => 'دوره های اموزشی'],
            'category' => ['link' => route('courses',['category' => $this->course->category->slug]) ,'label' => $this->course->category->title],
            'course' => ['link' => '' , 'label' => $this->course->title],
        ];
        $ids = array_value_recursive('id',$this->categoryRepository->find($this->course->category_id)->toArray());
        $this->related_courses = $this->courseRepository->whereIn('category_id',$ids,3,true,[['id' , '!=' , $this->course->id]]);
        $this->comments = $this->course->comments;
    }

    public function render()
    {
        $this->episodes = collect( $this->courseRepository->getEpisodes($this->course))->sortBy('view');
        return view('site.courses.single-course')->extends('site.layouts.site.site');
    }

    public function addToCart()
    {
        Cart::add($this->course);
        return redirect()->route('cart');
    }

    public function set_content($type,$id)
    {
        $this->reset(['api_bucket']);
        if (!auth()->check())
            return $this->emitNotify('لطفا ابتدا وارد شوید');

        $episode = $this->episodeRepository->find($id);
        $this->episode_id = $episode->id;
        $free = $episode->price == 0;
        $user_has_episode = $this->user->hasCourse($this->course->id);
        if ($this->course->price == 0 && !$user_has_episode){
            $order = [
                'user_id' => auth()->id(),
                'user_ip' => request()->ip(),
                'price'=> 0,
                'total_price' => 0,
                'reduction_code' =>  null,
                'reductions_value' => 0,
                'wallet_pay'=>0,
                'discount' => 0,
                'transactionId' => null,
            ];
            try {
                DB::beginTransaction();
                $order = $this->orderRepository->create($order);
                $this->orderDetailRepository->create([
                    'course_id' => $this->course->id,
                    'product_data' => json_encode(['id' => $this->course->id, 'title' => $this->course->title]),
                    'price' => (0),
                    'total_price' => 0,
                    'status' => OrderEnum::STATUS_COMPLETED,
                    'quantity' => 1,
                    'order_id' => $order->id,
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                $this->emitNotify('خطا در هنگام ثبت دوره','warning');
            }
        }
        switch ($type){
            case 'api_bucket':
                if (!is_null($episode->api_bucket) and (($free || $this->course->price == 0) || $user_has_episode)):
                    $this->episode_title = $episode->title;
                    return $this->api_bucket = $episode->api_bucket;
                    endif;
                break;
            case 'local_video':
                if ( ($free || $this->course->price == 0) || $user_has_episode) {
                    if ($disk = getDisk($episode->video_storage))
                        return $disk->download($episode->local_video);
                }
                break;
            case 'show_local_video':
                if (!is_null($episode->local_video) and $episode->allow_show_local_video and (($free || $this->course->price == 0) || $user_has_episode)):
                    $this->episode_title = $episode->title;
                    $this->local_video = route('storage',[$episode->id,'video']);
                endif;
                break;
            case 'file':
                if ($disk = getDisk($episode->file_storage))
                    if ($disk->exists($episode->file) and (($free || $this->course->price == 0) || $user_has_episode))
                        return $disk->download($episode->file);
                break;
            case 'link':
                if (!is_null($episode->link) and (($free || $this->course->price == 0) || $user_has_episode))
                    return redirect()->away($episode->link);
                break;
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

        $data = [
            'user_id' => auth()->id(),
            'content' => $this->comment,
            'parent_id'=> $this->actionComment ?? null,
        ];
        $this->courseRepository->newComment($this->course,$data);
        $this->reset(['comment','actionLabel','actionComment']);
        return $this->emitNotify(' دیدگاه با موفقیت ثبت شد پس از تایید نمایش داده خواهد شد');
    }

    public function moreComment()
    {
        $this->commentCount = $this->commentCount + 10;
    }
}
