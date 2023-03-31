<section class="footer-area pt-100px shadow-none p-3 mb-0 bg-light rounded">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold pb-2">شرکت</h3>
                    <div class="divider border-bottom-0"><span></span></div>
                    <ul class="generic-list-item">
                        <li><a href="{{ route('about') }}">درباره ما</a></li>
                        <li><a href="{{ route('contact') }}">با ما تماس بگیرید</a></li>
                        <li><a href="{{ route('fag') }}">سوالات متداول</a></li>
                        <li><a href="{{ route('courses') }}">دوره های آموزشی</a></li>
                        <li><a href="{{ route('teachers') }}">مدرسین</a></li>
                        <li><a href="{{ route('samples') }}">نمونه سوالات</a></li>
                    </ul>
                </div>
                <!-- end footer-item -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-2 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold pb-2">صفحات</h3>
                    <div class="divider border-bottom-0"><span></span></div>
                    <ul class="generic-list-item">
                        <li><a href="{{route('home')}}">صفحه اصلی</a></li>
                        @if($users_can_send_teacher_request)
                            <li><a href="{{ route('teacher.apply') }}">مدرس شوید</a></li>
                        @endif
                        <li><a href="{{ route('articles') }}">مقالات</a></li>
                        <li><a href="{{route('user.dashboard')}}">ناحیه کاربری</a></li>
                        <li><a href="{{route('cart')}}">سبد خرید </a></li>
                        <li><a href="{{route('checkout')}}">تکمیل خرید</a></li>
                    </ul>
                </div>
                <!-- end footer-item -->
            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">

                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold pb-2">نماد های اعتماد</h3>
                    <div class="divider border-bottom-0"><span></span></div>
                    <div class="text-right ">
                        @foreach($autographs as $item)
                            <div class="d-inline-block autograph">
                                {!! $item !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- end footer-item -->

            </div>
            <!-- end col-lg-3 -->
            <div class="col-lg-4 responsive-column-half">
                <div class="footer-item">
                    <h3 class="fs-20 font-weight-semi-bold pb-2">اخبار و مقلات</h3>
                    <div class="divider border-bottom-0"><span></span></div>
                    <form method="get" wire:submit.prevent="search" class="subscriber-form">
                        <p class="pb-3 lh-24">به دنبال اخبار خاصی می گردید؟</p>
                        <div class="form-group">
                            <input type="text" wire:model.defer="search" name="text" class="form-control form--control pl-3" placeholder="جستوجو اخبار" />
                            <button wire:click="search" class="btn theme-btn w-100 mt-3" type="button">جستجو <i class="la la-arrow-left icon ml-1"></i></button>
                        </div>
                    </form>
                </div>
                <!-- end footer-item -->
            </div>

            <!-- end col-lg-3 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    <div class="section-block"></div>
    <div class="copyright-content py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="d-flex flex-wrap align-items-center">
                        <a href="{{ route('home') }}" class="pr-4">
                            <img class="logo-footer" src="{{ asset($logo) }}" alt="لوگوی پاورقی" class="footer__logo" />
                        </a>
                        <p class="copy-desc">{{$copyRight}}</p>
                    </div>
                </div>
                @if(sizeof($links) > 0)
                    <div class="col-lg-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end">
                            <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                                @foreach($links as $link)
                                    <li class="mr-3"><a href="{{$link['link']}}">{{$link['title']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end copyright-content -->
</section>
