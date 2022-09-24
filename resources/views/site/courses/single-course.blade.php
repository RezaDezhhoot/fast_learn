<div wire:init="loadCourse">
    <x-site.courses.breadcrumbs :data="$page_address" :course="$course" />
    <section class="course-details-area pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pb-5">
                    <div class="course-dashboard-column w-100 pt-5">
                        <div class="lecture-viewer-container col-12 p-0">
                            <div class="lecture-video-item col-12  p-0" id="videoContent">
                                @if(!is_null($api_bucket))
                                <div class="col-12 p-0">
                                    {!! $api_bucket !!}
                                </div>
                                <div class="mt-2">
                                    <button class="btn btn-outline-primary"
                                        onclick="back_to_episode('heading{{$episode_id}}')">بازگشت به درس</button>
                                </div>
                                @elseif(!is_null($local_video))
                                <div
                                    class="plyr plyr--full-ui plyr--video plyr--html5 plyr--fullscreen-enabled plyr--paused">
                                    <video id="player" class="player" playsinline controls
                                        data-poster="{{asset($course->image)}}">

                                    </video>
                                </div>

                                <div class="mt-2">
                                    <button class="btn btn-outline-primary"
                                        onclick="back_to_episode('heading{{$episode_id}}')">بازگشت به درس</button>
                                </div>
                                @else
                                <img src="{{asset($course->image)}}" class="col-12  p-0" alt="{{ $course->title }}">
                                @endif
                                <p class="text-info" wire:loading> در حال دریافت... </p>
                            </div>
                        </div>
                    </div>

                    <div class="course-details-content-wrap mt-5">
                        {!! $course->long_body !!}
                        <div class="course-overview-card">
                            <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                                <h3 class="fs-24 font-weight-semi-bold">محتوای دوره</h3>
                                <div class="curriculum-duration fs-15">
                                    <span class="curriculum-total__text mr-2"><strong
                                            class="text-black font-weight-semi-bold">مجموع:</strong> {{
                                        $course->episodes->count() }} مبحث </span>
                                    <span class="curriculum-total__hours"><strong
                                            class="text-black font-weight-semi-bold">کل ساعت:</strong> {{ $course->time
                                        }}</span>
                                </div>
                            </div>
                            <div class="curriculum-content">

                                <div id="accordion" class="generic-accordion" wire:ignore>
                                    @if(sizeof($episodes) > 0)
                                    @foreach($episodes as $key => $item)
                                    <div class="card">
                                        <div class="card-header" id="heading{{$item['id']}}">
                                            <button
                                                class="btn btn-link d-flex align-items-center justify-content-between"
                                                data-toggle="collapse" data-target="#collapse{{$item->id}}"
                                                aria-expanded="{{  $key == 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{$item->id}}">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                                <p>
                                                    <small class="episode_counter">{{ $loop->iteration }}</small>
                                                    {{ $item['title'] }}
                                                </p>

                                                @if($item['free'] || $course->price == 0)
                                                <small class="text-success">رایگان <i class="la la-lock-open">
                                                    </i></small>
                                                @elseif(auth()->check() && $user->hasCourse($course->id))
                                                <small class="text-success">خریداری شده <i class="la la-lock-open">
                                                    </i></small>
                                                @elseif(!auth()->check() || (auth()->check() &&
                                                !$user->hasCourse($course->id)))
                                                <div class="text-left">
                                                    <small class="text-danger">نقدی <i class="la la-lock">
                                                        </i></small>
                                                </div>
                                                @endif
                                            </button>
                                        </div>
                                        <!-- end card-header -->

                                        <div id="collapse{{$item->id}}" class="collapse {{  $key == 0 ? 'show' : '' }}"
                                            aria-labelledby="heading{{$item->id}}" data-parent="#accordion">
                                            @if(auth()->check())
                                            @if((($item['free'] || $course->price == 0) ||
                                            ($user->hasCourse($course->id))))
                                            <div class="card-body pt-2">
                                                @if(!empty($item->description))
                                                <p class="px-0 text-black">
                                                    <i class="la la-star mr-1"></i>
                                                    {{ $item->description }}
                                                </p>
                                                @endif
                                                <hr>
                                                <ul class="generic-list-item">
                                                    @if(!empty($item['api_bucket']) && $item['show_api_video'] )
                                                    <li>
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span
                                                                wire:click="set_content('api_bucket','{{$item['id']}}')"
                                                                class="cursor-pointers showVideo">
                                                                <i class="la la-play-circle mr-1"></i>
                                                                نمایش ویدئو
                                                            </span>
                                                            <span>{{ $item['time'] }}</span>
                                                        </a>
                                                    </li>

                                                    @elseif(!empty($item['local_video']))
                                                    @if($item['allow_show_local_video'])
                                                    <li>
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span
                                                                wire:click="set_content('show_local_video','{{$item['id']}}')"
                                                                class="cursor-pointers showVideo">
                                                                <i class="la la-play-circle mr-1"></i>
                                                                نمایش ویدئو
                                                            </span>
                                                            <span>{{ $item['time'] }}</span>
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @if ($item['downloadable_local_video'])
                                                    <li>
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span
                                                                wire:click="set_content('local_video','{{$item['id']}}')"
                                                                class="cursor-pointers">
                                                                <i class="la la-download mr-1"></i>
                                                                دانلود ویدئو
                                                            </span>
                                                        </a>
                                                    </li>

                                                    @endif

                                                    @endif
                                                    @if(!empty($item['file']))
                                                    <li>
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span wire:click="set_content('file','{{$item['id']}}')"
                                                                class="cursor-pointers">
                                                                <i class="la la-file mr-1"></i>
                                                                دانلود فایل
                                                            </span>

                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if(!empty($item['link']) )
                                                    <li>
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span wire:click="set_content('link','{{$item['id']}}')"
                                                                class="cursor-pointers">
                                                                <i class="la la-link mr-1"></i>
                                                                لینک
                                                            </span>

                                                        </a>
                                                    </li>
                                                    @endif
                                                    @if($item->can_homework)
                                                    <li data-toggle="modal" data-target="#homeworkModal">
                                                        <a class="d-flex align-items-center justify-content-between"
                                                            data-toggle="modal" data-target="#previewModal">
                                                            <span wire:click="homework('{{$item['id']}}')"
                                                                class="cursor-pointers">
                                                                <i class="la la-file-import mr-1"></i>
                                                                ارسال تمرین
                                                            </span>

                                                        </a>
                                                    </li>
                                                    @endif
                                                    <small class="text-info" wire:loading>
                                                        در حال دریافت ...
                                                    </small>
                                                </ul>
                                            </div>
                                            @else
                                            <p class="alert alert-danger">دوره خریداری نشده است.</p>
                                            @endif
                                            @else
                                            <p class="alert alert-info">دسترسی به این بخش نیاز به ثبت نام دارد.</p>
                                            @endif
                                        </div>
                                        <!-- end collapse -->
                                    </div>
                                    @endforeach
                                    @else
                                    <p class="alert alert-info">
                                        هنوز هیچ درسی منتشر نشده است.
                                    </p>
                                    @endif
                                </div>
                                <!-- end generic-accordion -->
                            </div>
                            <!-- end curriculum-content -->
                        </div>
                        <!-- end course-overview-card -->
                        @if(!is_null($course->teacher))
                        <div class="course-overview-card pt-4">
                            <h3 class="fs-24 font-weight-semi-bold pb-4">در مورد مربی</h3>
                            <div class="instructor-wrap">
                                <div class="media media-card">
                                    <div class="instructor-img">
                                        <a href="{{ route('teacher',$course->teacher->user->id) }}"
                                            class="media-img d-block">
                                            <img class="lazy" src="{{ asset($course->teacher->user->image) }}"
                                                data-src="{{ asset($course->teacher->user->image) }}"
                                                alt="{{ $course->teacher->user->name }}" />
                                        </a>
                                        <ul class="generic-list-item pt-3">
                                            <li><i class="la la-user mr-2 text-color-3"></i> {{
                                                $course->teacher->user->students_count }} دانش آموز </li>
                                            <li><i class="la la-comment-o mr-2 text-color-3"></i> {{
                                                number_format($course->teacher->user->comments_count) }} نظر</li>
                                            <li><i class="la la-play-circle-o mr-2 text-color-3"></i> {{
                                                $course->teacher->user->course_count }} دوره</li>
                                            <li><a
                                                    href="{{ route('courses',['teacher'=>$course->teacher->user->code]) }}">مشاهده
                                                    تمام دوره ها</a></li>
                                        </ul>
                                    </div>
                                    <!-- end instructor-img -->
                                    <div class="media-body">
                                        <h5><a href="{{ route('teacher',$course->teacher->id) }}">{{
                                                $course->teacher->user->name }}</a></h5>
                                        <span class="d-block lh-18 pt-2 pb-3"> شروع فعالیت از {{
                                            $course->teacher->created_at->diffForHumans() }} </span>
                                        <p class="pb-3">
                                            {!! $course->teacher->body !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- end instructor-wrap -->
                        </div>
                        @endif
                        <!-- end course-overview-card -->
                        @auth
                        <div class="course-overview-card pt-4">
                            <h3 class="fs-24 font-weight-semi-bold pb-4">{{ $actionLabel }}</h3>
                            <form method="post" id="commentForm" class="row" wire:submit.prevent="new_comment">
                                @auth
                                <div class="input-box col-lg-12">
                                    <label class="label-text">پیام</label>
                                    <div class="form-group">
                                        <textarea wire:model.defer="comment" class="form-control form--control pl-3"
                                            name="message" placeholder="پیام بنویس" rows="5"></textarea>
                                    </div>
                                    @error('comment')
                                    <span class="invalid-feedback d-block">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="input-box col-lg-12 text-right overflow-hidden mb-3">
                                    <div class="g-recaptcha d-inline-block"
                                        data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                        data-callback="reCaptchaCallback" wire:ignore></div>
                                    @error('recaptcha')<span class="invalid-feedback d-block">{{ $message
                                        }}</span>@enderror
                                </div>
                                <div class="btn-box col-lg-12">
                                    <!-- end custom-control -->
                                    <button class="btn theme-btn" type="submit">ارسال دیدگاه</button>
                                </div>
                                @else
                                <p class="text-info">
                                    برای ثبت دیدگاه ابتدا ثبت نام کنید
                                </p>
                                @endif
                                <!-- end btn-box -->
                            </form>
                        </div>
                        @else
                        <p class="text-info">
                            برای ثبت دیدگاه ابتدا ثبت نام کنید
                        </p>
                        @endif
                        <div class="course-overview-card pt-4">
                            <h3 class="fs-24 font-weight-semi-bold pb-4">پرسش و پاسخ</h3>
                            <div class="review-wrap">
                                @if(sizeof($comments) > 0)
                                @for($i=0;$i<$commentCount ;$i++) @isset($comments[$i]) <div
                                    class="media media-card shadow-sm p-3 mb-4 bg-white rounded pb-4 mb-1">
                                    <div class="media-img mr-4 rounded-full">
                                        <img class="rounded-full lazy" src="{{ asset($comments[$i]->user->image) }}"
                                            data-src="{{ asset($comments[$i]->user->image) }}"
                                            alt="{{ $comments[$i]->user->name }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                            <h5>{{ $comments[$i]->user->name }} {{ $comments[$i]->user->id ==
                                                $course->teacher->id ? " (مدرس) " : '' }}</h5>
                                        </div>
                                        <span class="d-block lh-18 py-2">{{ $comments[$i]->created_at->diffForHumans()
                                            }}</span>
                                        <p class="pb-2">
                                            {!! $comments[$i]->content !!}
                                        </p>
                                        <div class="helpful-action">
                                            <button wire:click="$set('actionComment',{{$comments[$i]->id}})"
                                                class="btn btn-outline-success goToCommentForm">پاسخ</button>
                                        </div>
                                    </div>
                            </div>
                            @foreach($comments[$i]->childrenRecursive as $value)
                            <div
                                class="media media-card pb-4 shadow-sm p-3 mb-5 bg-white rounded p-3 mb-4 review-reply">
                                <div class="media-img mr-4 rounded-full">
                                    <img class="rounded-full lazy" src="{{ asset($value->user->image) }}"
                                        data-src="{{ asset($value->user->image) }}" alt="{{ $value->user->name }}" />
                                </div>
                                <div class="media-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                        <h5>{{ $value->user->name }} {{ $value->user->id == $course->teacher->id ? "
                                            (مدرس) " : '' }}</h5>
                                    </div>
                                    <span class="d-block lh-18 py-2">{{ $value->created_at->diffForHumans() }}</span>
                                    <p class="pb-2">
                                        {!! $value->content !!}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            @if ($i != count($comments) - 1)
                            <hr>
                            @endif
                            @endif

                            @endfor
                            @else
                            <p class="alert alert-info">
                                هیچ پرسش و پاسخی ثبت نشده است
                            </p>
                            @endif

                            <!-- end media -->
                        </div>
                        <!-- end review-wrap -->
                        <div class="see-more-review-btn text-center">
                            @if($commentCount < count($comments))
                                <button type="button" wire:click="moreComment()"
                                    class="btn theme-btn theme-btn-transparent">بارگیری نظرات بیشتر</button>
                                @endif
                        </div>
                    </div>
                </div>
                <!-- end course-details-content-wrap -->
            </div>
            <!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar sidebar-negative">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="preview-course-feature-content pt-1 mb-">
                                <div class="">
                                    @if($course->has_reduction && $course->base_price > 0)
                                    <div class="m-0 p-0">
                                        <p class="before-price mx-1"> {{ number_format($course->base_price) }} </p>
                                        @if($course->price > 0)
                                        <span class="fs-35 font-weight-semi-bold text-black">{{
                                            number_format($course->price) }} تومان</span>
                                        @else
                                        <span class="fs-35 font-weight-semi-bold text-black">رایگان</span>
                                        @endif
                                    </div>
                                    <p class="price-discount p-1">{{ $course->reduction_percent }} درصد تخفیف</p>
                                    @if(!empty($course->expire_at))
                                    <p class="preview-price-discount-text pt-4"><span class="text-color-3">{{
                                            $course->expire_at->diffForHumans() }}</span> با این قیمت!</p>
                                    @endif
                                    @elseif($course->base_price == 0 || $course->price == 0)
                                    <span class="fs-35 font-weight-semi-bold text-black">رایگان</span>
                                    @else
                                    <span class="fs-35 font-weight-semi-bold text-black">{{
                                        number_format($course->price) }} تومان</span>
                                    @endif
                                </div>
                                <div class="buy-course-btn-box mt-4">
                                    @if ($course->price == 0)
                                    @if (auth()->check() && $user->hasCourse($course->id))
                                    <button disabled type="button" class="btn btn-outline-success w-100 mb-2">شما در این دوره ثبت نام کرده اید</button>
                                    @else
                                    <button wire:click="getFreeOrder()" type="button" class="btn theme-btn w-100 mb-2"><i
                                        class="la la-shopping-cart fs-18 mr-1"></i> ثبت
                                    نام در این دوره</button>
                                    @endif

                                    @else
                                    <button wire:click="addToCart()" type="button" class="btn theme-btn w-100 mb-2"><i
                                            class="la la-shopping-cart fs-18 mr-1"></i> به سبد خرید اضافه کنید</button>
                                    @endif

                                </div>
                                <div class="preview-course-incentives">
                                    <h3 class="card-title fs-18 mt-2 pb-2">این دوره شامل</h3>
                                    <ul class="generic-list-item pb-3">
                                        <li><i class="la la-play-circle-o mr-2 text-color"></i>{{ $course->hours }} ساعت
                                            ویدیو اموزشی </li>
                                        <li><i class="la la-key mr-2 text-color"></i>دسترسی کامل مادام العمر</li>
                                    </ul>
                                </div>
                                <!-- end preview-course-incentives -->
                            </div>
                            <!-- end preview-course-content -->
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">ویژگی های دوره</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash">
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-clock mr-2 text-color"></i>مدت زمان</span> {{ $course->time }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-circle mr-2 text-color"></i>وضعیت </span> {{
                                    $course->status_label }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-bolt mr-2 text-color"></i>امتحان</span> {{
                                    !is_null($course->quiz) ? 'بعله' : 'خیر' }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-eye mr-2 text-color"></i>درس ها</span> {{
                                    $course->episodes->count() }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-lightbulb mr-2 text-color"></i>سطح دوره</span> {{
                                    $course->level_label }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-gear mr-2 text-color"></i>نوع دوره</span> {{
                                    $course->type_label }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-certificate mr-2 text-color"></i>گواهی</span> {{
                                    (!is_null($course->quiz) && !is_null($course->quiz->certificate)) ? 'بعله' : 'خیر'
                                    }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($has_sample)
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">نمونه سوالات</h3>
                                <div class="divider"><span></span></div>
                                
                                @foreach($course->samples as $item)
                                    <div class="">
                                        @livewire('components.site.samples.sample-row', ['sample' => $item])
                                    </div>
                                @endforeach
                                <!-- end media -->
                                <div class="view-all-course-btn-box">
                                    <a href="{{ route('samples') }}" class="btn theme-btn w-100">مشاهده همه  نمونه سوالات <i
                                            class="la la-arrow-left icon ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">دوره های مرتبط</h3>
                            <div class="divider"><span></span></div>
                            @foreach($related_courses as $item)
                            <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                <a href="{{ route('course',$item->slug) }}" class="media-img">
                                    <img class="mr-3 lazy" src="{{ asset($item->image) }}"
                                        data-src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                                </a>
                                <div class="media-body">
                                    <h5 class="fs-15"><a href="{{ route('course',$item->slug) }}">{{ $item->title }}</a>
                                    </h5>
                                    <span class="d-block lh-18 py-1 fs-14">{{ $item->teacher->name ?? '' }}</span>
                                    <p class="text-black font-weight-semi-bold lh-18 fs-15">{{ $item->price >0 ?
                                        number_format($item->price).' تومان' : 'رایگان' }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- end media -->
                            <div class="view-all-course-btn-box">
                                <a href="{{ route('courses') }}" class="btn theme-btn w-100">مشاهده همه دوره ها <i
                                        class="la la-arrow-left icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">برچسب های دوره</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                @foreach($course->tags as $item)
                                <li class="mr-2"><a href="{{ route('courses',['q' => $item->name]) }}"> {{ $item->name
                                        }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end sidebar -->
            </div>
            <!-- end col-lg-4 -->
        </div>
        <!-- end row -->
</div>
<!-- end container -->
</section>

<div wire:ignore.self class="modal fade modal-container" id="homeworkModal" tabindex="-1" role="dialog"
    aria-labelledby="homeworkModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">ارسال تمرین</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div>
                <div>
                    @if(!is_null($homework) && empty($homework->result))
                    <button class="btn btn-sm btn-outline-danger" onclick="delete_homework()"><i
                            class="la la-trash"></i> حذف این تمرین</button>
                    @endif
                </div>
            </div>
            <div class="modal-body">
                @if($show_homework_form)
                <form wire:submit.prevent="submit_homework()">
                    <div class="row">
                        @auth
                        <div class="input-box col-12">
                            <div class="form-group">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    class="custom-file my-4">
                                    <input {{ !is_null($homework) ? 'disabled' : '' }} type="file"
                                        class="custom-file-input" wire:model="homework_file" id="homework_file">
                                    <label class="custom-file-label" for="homework_file">انتخاب فایل</label>
                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <small class="text-info">حداقل حجم مجاز : 2 مگابایت</small>
                                    <small class="text-info">jpg,jpeg,png,pdf,zip,rar</small>
                                    @if(!is_null($homework) && !is_null($homework->file))
                                    <small class="alert d-block p-1 alert-success">فایل ارسال شده است</small>
                                    @endif
                                    @error('homework_file')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-box col-lg-12">
                            <label class="label-text">توضیحات</label>
                            <div class="form-group">
                                <textarea {{ !is_null($homework) ? 'disabled' : '' }}
                                    wire:model.defer="homework_description" class="form-control form--control pl-3"
                                    name="homework_description" placeholder="توضیحات" rows="5"></textarea>
                            </div>
                            @error('homework_description')
                            <span class="invalid-feedback d-block">{{$message}}</span>
                            @enderror
                        </div>
                        <div
                            class="input-box col-lg-12 text-right overflow-hidden mb-3">
                            <div class="g-recaptcha d-inline-block"
                                data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                data-callback="homeworkReCaptchaCallback" wire:ignore></div>
                            @error('homework_recaptcha')<span class="invalid-feedback d-block">{{ $message
                                }}</span>@enderror
                        </div>
                        <div class="btn-box col-lg-12 {{ !is_null($homework) ? 'd-none' : '' }}">
                            <button {{ !is_null($homework) ? 'disabled' : '' }} class="btn theme-btn"
                                type="submit">ارسال تمرین</button>
                        </div>
                        @if(!is_null($homework) && !is_null($homework->result))
                        <div class="col-12">
                            <h6>نتیجه :</h6>
                            <small>
                                @for($i=1; $i<=5; $i++) @if($i <=$homework->score)
                                    <span class="la la-star"></span>
                                    @else
                                    <span class="la la-star-o"></span>
                                    @endif
                                    @endfor
                            </small>
                            <p class="mr-1">
                                {!! $homework->result !!}
                            </p>
                        </div>
                        @endif
                        @else
                        <p class="text-info">
                            برای ارسال تمرین ابتدا ثبت نام کنید
                        </p>
                        @endif
                    </div>
                </form>
                @else
                <p class="alert alert-danger">شما به این بخش دسترسی ندارید.</p>
                @endif
            </div>
            <div class="modal-footer justify-content-center border-top-gray">

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">این دوره را به اشتراک بگذارید
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div>
            <!-- end modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">کپی شده!</span>
                    <div class="input-group">
                        <input type="text" class="form-control form--control copy-input pl-3"
                            value="{{ route('codes',$course->short_code) }}" />
                        <div class="input-group-append">
                            <button class="btn theme-btn theme-btn-sm copy-btn shadow-none"><i
                                    class="la la-copy mr-1"></i> کپی</button>
                        </div>
                    </div>
                </div>
                <!-- end copy-to-clipboard -->
            </div>
            <!-- end modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('codes',$course->short_code) }}"
                            class="facebook-bg"><i class="la la-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/intent/tweet?text={{ route('codes',$course->short_code) }}"
                            class="twitter-bg"><i class="la la-twitter"></i></a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('codes',$course->short_code) }}"
                            class="linkedin-bg"><i class="la la-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <!-- end modal-footer -->
        </div>
        <!-- end modal-content-->
    </div>
    <!-- end modal-dialog -->
</div>
</div>
@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    function delete_homework() {
            Swal.fire({
                title: 'حذف تمرین!',
                text: 'آیا از حذف این تمرین اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    @this.call('delete_homework')
                }
            })
        }
        function homeworkReCaptchaCallback(response) {
            @this.set('homework_recaptcha', response);
        }

        function reCaptchaCallback(response) {
            @this.set('recaptcha', response);
        }

        function back_to_episode(id)
        {
            $('html, body').animate({
                scrollTop: $(`#${id}`).offset().top
            }, 1000);
        }

        Livewire.on('resetReCaptcha', () => {
            grecaptcha.reset();
        });

        Livewire.on('loadRecaptcha', () => {
            const script = document.createElement('script');

            script.setAttribute('src', 'https://www.google.com/recaptcha/api.js');

            const start = document.createElement('script');


            document.body.appendChild(script);
            document.body.appendChild(start);
        });
</script>
@endpush
