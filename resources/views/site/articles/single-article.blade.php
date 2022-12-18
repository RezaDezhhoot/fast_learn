<div  wire:init="loadMore">
    <x-site.articles.breadcrumbs :data="$page_address" :article="$article" />

    <section class="blog-area pt-100px pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            {!! $article->body !!}
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="instructor-wrap py-5">
                        <h3 class="fs-22 font-weight-semi-bold pb-4">درباره نویسنده</h3>
                        <div class="media media-card">
                            <div class="media-img rounded-full avatar-lg mr-4">
                                <img src="{{ asset($article->user->image) }}"
                                    data-src="{{ asset($article->user->image) }}" alt="{{ $article->user->name }}"
                                    class="rounded-full lazy" />
                            </div>
                            <div class="media-body">
                                <h5> {{ $article->user->name }}</h5>
                                <span class="d-block lh-18 pt-2 pb-3"> شروع فعالیت از {{
                                    $article->user->created_at->diffForHumans() }} </span>
                            </div>
                        </div>
                    </div>
                    <!-- end instructor-wrap -->
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
                                @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
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
                        <h3 class="fs-24 font-weight-semi-bold pb-4">نظرات</h3>
                        <div class="review-wrap">
                            @if(sizeof($comments) > 0)
                            @for($i=0;$i<$commentCount ;$i++) @isset($comments[$i]) <div
                                class="media media-card shadow-sm p-3 mb-5 bg-white rounded  pb-4 mb-1">
                                <div class="media-img mr-4 rounded-full">
                                    <img class="rounded-full lazy" src="{{ asset($comments[$i]->user->image) }}"
                                        data-src="{{ asset($comments[$i]->user->image) }}"
                                        alt="{{ $comments[$i]->user->name }}" />
                                </div>
                                <div class="media-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                        <h5>{{ $comments[$i]->user->name }}</h5>
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
                        <div class="media media-card pb-4 shadow-sm p-3 mb-5 bg-white rounded p-4 mb-4 review-reply">
                            <div class="media-img mr-4 rounded-full">
                                <img class="rounded-full lazy" src="{{ asset($value->user->image) }}"
                                    data-src="{{ asset($value->user->image) }}" alt="{{ $value->user->name }}" />
                            </div>
                            <div class="media-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between pb-1">
                                    <h5>{{ $value->user->name }}</h5>
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
                            هیچ نظری ثبت نشده است
                        </p>
                        @endif
                        <!-- end media -->
                    </div>
                    <!-- end review-wrap -->
                    <div class="see-more-review-btn text-center">
                        @if($commentCount < $comments->count())
                            <button type="button" wire:click="moreComment()"
                                class="btn theme-btn theme-btn-transparent">بارگیری نظرات بیشتر</button>
                            @endif
                    </div>
                </div>
            </div>
            <!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">فیلد جستجو</h3>
                            <div class="divider"><span></span></div>
                            <form wire:submit.prevent="search">
                                <div class="form-group mb-0">
                                    <input wire:model.defer="q" class="form-control form--control pl-3" type="search"
                                        name="q" placeholder="جستجوی مقاله" />
                                    <span wire:click="search" class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">پستهای مرتبط</h3>
                            <div class="divider"><span></span></div>
                            @foreach($related_posts as $item)
                            <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                <a href="{{ route('articles',$item->slug) }}" class="media-img">
                                    <img class="mr-3" src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                                </a>
                                <div class="media-body">
                                    <h5 class="fs-15"><a href="{{ route('articles',$item->slug) }}">{{ $item->title }}</a>
                                    </h5>
                                    <span class="d-block lh-18 py-1 fs-14">{{ $item->user->name }}</span>
                                </div>
                            </div>
                            @endforeach
                            <div class="view-all-course-btn-box">
                                <a href="{{ route('articles') }}" class="btn theme-btn w-100">مشاهده همه پست ها <i
                                        class="la la-arrow-left icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">برچسب های پست</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-boxed d-flex flex-wrap fs-15">
                                @foreach($article->tags as $item)
                                <li class="mr-2"><a href="{{ route('articles',['q' => $item->name]) }}">{{ $item->name
                                        }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end sidebar -->
            </div>
            <!-- end col-lg-4 -->
        </div>
        <!-- end row -->
</div>
<!-- end container -->
</section>


</div>
@push('scripts')

<script>
    function reCaptchaCallback(response) {
        @this.set('recaptcha', response);
        }

        function back_to_episode(id)
        {
            $('html, body').animate({
                scrollTop: $(`#episode${id}`).offset().top
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
