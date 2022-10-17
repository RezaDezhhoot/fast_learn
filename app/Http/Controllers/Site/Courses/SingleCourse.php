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
    public  $related_courses = [] , $comments = [] , $recaptcha , $episodes , $user , $commentCount = 10 , $actionComment  , $actionLabel = 'دیدگاه جدید';
    public ?string $api_bucket = null , $local_video , $comment = null , $episode_title = null , $episode_id;

    public $homework , $file_path , $homework_file , $homework_description , $homework_recaptcha;

    public $episode , $show_homework_form = false , $has_samples = false;

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
        $this->has_sample = sizeof($this->course->samples) > 0;
        if (Auth::check())
            $this->show_homework_form = $this->user->hasCourse($this->course->id);
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
    }

    public function render()
    {
        $this->episodes = collect($this->course->episodes)->sortBy('view');

        return view('site.courses.single-course')->extends('site.layouts.site.site');
    }

    public function addToCart()
    {
        if ($this->course->price > 0) {
            Cart::add($this->course);
            return redirect()->route('cart');
        }

    }

    public function set_content($type,$id)
    {
        $this->reset(['api_bucket']);
        if (!auth()->check())
            return $this->emitNotify('لطفا ابتدا وارد شوید');

        $episode = $this->episodeRepository->find($id);
        $this->episode_id = $episode->id;
        $user_has_episode = $this->user->hasCourse($this->course->id) || $episode->free;
        if ($this->course->price == 0 && !$user_has_episode){
            $this->getFreeOrder();
        }
        try {
            switch ($type){
                case 'api_bucket':
                    if (!is_null($episode->api_bucket) and $episode->show_api_video and (($this->course->price == 0) || $user_has_episode)):
                        $this->episode_title = $episode->title;
                        return $this->api_bucket = $episode->api_bucket;
                        endif;
                    break;
                case 'local_video':
                    if ( ( $this->course->price == 0 || $user_has_episode) and $episode->downloadable_local_video ) {
                        if ($disk = getDisk($episode->video_storage))
                            return $disk->download($episode->local_video);
                    }
                    break;
                case 'show_local_video':
                    if (!is_null($episode->local_video) and $episode->allow_show_local_video and ($this->course->price == 0 || $user_has_episode)):
                        $this->episode_title = $episode->title;
                        $this->local_video = route('storage',[$episode->id,'video']);
                        $this->emit('setVideo',['title' => '1','src' => $this->local_video]);
                    endif;
                    break;
                case 'file':
                    if ($disk = getDisk($episode->file_storage))
                        if ($disk->exists($episode->file) and (( $this->course->price == 0) || $user_has_episode))
                            return $disk->download($episode->file);
                    break;
                case 'link':
                    if (!is_null($episode->link) and ((  $this->course->price == 0) || $user_has_episode))
                        return redirect()->away($episode->link);
                    break;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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

    public function homework($id)
    {
        $this->resetHomework();
        if (Auth::check()) {
            if ($rateKey = rateLimiter(value:Auth::id().'_homework_'.$this->course->id,max_tries: 100))
            {
                $this->show_homework_form = false;
                return $this->emitNotify('زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
            }
            $user_has_episode = $this->user->hasCourse($this->course->id);
            if ($this->course->price == 0 && !$user_has_episode)
                $user_has_episode = $this->getFreeOrder();

            if ($user_has_episode) {
                $this->episode = $this->episodeRepository->find($id);
                if (!is_null($this->episode) && $this->episode->can_homework){
                    $this->homework = $this->homeworkRepository->get([
                        ['user_id',auth()->id()],
                        ['episode_id',$this->episode->id]
                    ]);
                }
                if (!is_null($this->homework)) {
                    $this->file_path = $this->homework->file;
                    $this->homework_description = $this->homework->description;
                } else {
                    $this->emit('loadRecaptcha');
                }
            } else $this->emitNotify('شما هنوز این دوره را شروع نکرده اید','warning');
        }
    }

    public function delete_homework()
    {
        if (Auth::check()) {
            if (!is_null($this->episode) && !is_null($this->homework) && empty($this->homework->result)) {
                $this->homeworkRepository->destroy($this->homework->id);
                $this->resetHomework();
                $this->emitNotify('تمرین با موفقیت حذف شد');
            }
        }

    }

    public function submit_homework()
    {
        if (Auth::check()) {
            if ($rateKey = rateLimiter(value:Auth::id().'_homework_submit_'.$this->course->id,max_tries: 5))
            {
                $this->show_homework_form = false;
                return $this->emitNotify('زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.','warning');
            }
            $user_has_episode = $this->user->hasCourse($this->course->id);
            if ($user_has_episode) {
                if (!is_null($this->episode) && is_null($this->homework)) {
                    $this->validate([
                        'homework_file' => ['required','file','mimes:jpg,jpeg,png,PNG,JPG,JPEG,rar,zip','max:2048'],
                        'homework_description' => ['nullable','string','max:240'],
                        'homework_recaptcha' => ['required', new ReCaptchaRule],
                    ],[],[
                        'homework_file' => 'فایل تمرین',
                        'homework_description' => 'توضیحات تمرین',
                        'homework_recaptcha' => 'فیلد امنیتی'
                    ]);
                    $this->uploader();
                    $this->homework = $this->homeworkRepository->updateOrCreate([
                        'episode_id' => $this->episode->id,
                        'user_id' => auth()->id()
                    ],[
                        'file' => $this->file_path,
                        'description' => $this->homework_description,
                        'episode_title' => $this->episode->title,
                        'storage' => $this->episode->homework_storage
                    ]);
                    $this->emit('resetReCaptcha');
                    $this->emitNotify('تمرین شما با موفقیت ارسال شد');
                } else $this->emitNotify('امکان بارگذاری مجدد تمرین موجود نمی باشد','warning');
            } else $this->emitNotify('شما هنوز این دوره را شروع نکرده اید','warning');
        }
        $this->resetHomework();
    }

    private function uploader()
    {
        $disk = getDisk($this->episode->homework_storage);
        if (!empty($this->homework_file)) {
            $this->file_path = $disk->put('homeworks',$this->homework_file);
            $this->reset(['homework_file','file_path']);
        }
    }

    public function updatedHomeworkFile()
    {
        $this->resetErrorBag();
    }

    public function resetHomework()
    {
        $this->reset(['homework','homework_file','homework_description','file_path']);
    }

    public function getFreeOrder() {
        if (Auth::check()) {
            if ($this->course->price == 0 && !$this->user->hasCourse($this->course->id)) {
                $this->setOrder();
            }
        } else {
            return redirect()->route('auth');
        }
    }

    private function setOrder(): bool
    {
        $order = [
            'user_id' => auth()->id(),
            'user_ip' => request()->ip(),
            'price'=> $this->course->base_price,
            'total_price' => 0,
            'reduction_code' =>  null,
            'reductions_value' => $this->course->reduction_amount,
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
                'price' => $this->course->base_price,
                'total_price' => 0,
                'status' => OrderEnum::STATUS_COMPLETED,
                'reduction_amount' => $this->course->reduction_amount,
                'wallet_amount' => 0,
                'quantity' => 1,
                'order_id' => $order->id,
            ]);
            DB::commit();
            $this->show_homework_form = true;
            $this->emitNotify('دوره با موفقیت برای شما ثبت شد');
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->emitNotify('خطا در هنگام ثبت دوره','warning');
            return false;
        }
    }


}
