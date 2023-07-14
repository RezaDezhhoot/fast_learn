<div wire:init="loadCourse">
    <x-site.courses.breadcrumbs :data="$page_address" :course="$course" />
    <section class="course-details-area pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pb-5">
                    <div class="course-dashboard-column w-100 pt-5">
                        <div class="lecture-viewer-container col-12 p-0">
                            <div wire:ignore class="lecture-video-item col-12  p-0">
                                @if(!is_null($course->time_lapse))
                                <div class="plyr plyr--video plyr--html5 plyr--fullscreen-enabled">
                                    <video id="player" class="player" playsinline crossorigin controls data-poster="{{asset($course->image)}}" poster="{{asset($course->image)}}">
                                        <source src="{{asset($course->time_lapse)}}" type="video/mp4" />
                                    </video>
                                </div>
                                @else
                                    <img src="{{asset($course->image)}}" class="col-12  p-0" alt="{{ $course->title }}">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="course-details-content-wrap mt-5">
                        {!! $course->long_body !!}
                        <div class="course-overview-card">
                            <div class="curriculum-header d-flex align-items-center justify-content-between pb-4">
                                <h3 class="fs-24 font-weight-semi-bold">لیست محتوای دوره</h3>
                                <div class="curriculum-duration fs-15">
                                    <span class="curriculum-total__text mr-2"><strong
                                            class="text-black font-weight-semi-bold">مجموع:</strong> {{
                                        $course->chapters->count() }} مبحث </span>
                                    <span class="curriculum-total__hours"><strong
                                            class="text-black font-weight-semi-bold">کل ساعت:</strong> {{ $course->time
                                        }}</span>
                                </div>
                            </div>
                            @include('site.courses.chapters')
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
                                        <label class="label-text">نام شما</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="user_name" class="form-control form--control pl-3"
                                                   name="user_name">
                                        </div>
                                        @error('user_name')
                                        <span class="invalid-feedback d-block">{{$message}}</span>
                                        @enderror
                                    </div>
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
                                    @if($course->buyable)
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
                                    @else
                                        <button disabled type="button" class="btn theme-btn w-100 mb-2"><i
                                                class="la la-shopping-cart fs-18 mr-1"></i> عدم امکان ثبت نام</button>
                                    @endif

                                </div>
                                <div class="preview-course-incentives">
                                    <h3 class="card-title fs-18 mt-2 pb-2">این دوره شامل</h3>
                                    <ul class="generic-list-item pb-3">
                                        <li><i class="la la-play-circle-o mr-2 text-color"></i>{{ $course->hours }} ساعت
                                            ویدیو آموزشی </li>
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
                                    <span><i class="la la-circle mr-2 text-color"></i>پشتیبانی استاد </span> {{
                                    $course->has_support ? 'بله' : 'خیر' }}
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <span><i class="la la-bolt mr-2 text-color"></i>آزمون</span> {{
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
                    @if($has_samples)
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">نمونه سوالات</h3>
                                <div class="divider"><span></span></div>

                                @foreach($course->samples as $item)
                                    <div wire:ignore>
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
                        <a target="_blank" href="https://t.me/share/url?url={{ route('codes',$course->short_code) }}"
                            class="twitter-bg"><i class="la la-telegram"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ route('codes',$course->short_code) }}"
                            class="linkedin-bg"><i class="la la-linkedin"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="whatsapp://send/?text={{ route('codes',$course->short_code) }}"
                           class="linkedin-bg"><i class="la la-whatsapp"></i></a>
                    </li>
                    <li>
                        <a target="_blank" href="mailto:?subject={{$course->title }}"
                           class="linkedin-bg"><i class="la la-envelope"></i></a>
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

<script>
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

            script.setAttribute('src', 'https://www.google.com/recaptcha/api.js?hl=fa');

            const start = document.createElement('script');


            document.body.appendChild(script);
            document.body.appendChild(start);
        });

        Livewire.on('setVideo', data => {
            const player = new Plyr('#player',{
                title: data.title,
            });
        })
</script>
@endpush
