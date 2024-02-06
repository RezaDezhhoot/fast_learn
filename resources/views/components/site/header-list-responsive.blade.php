<div>
    <div class="logo-box  px-4">
        <a href="{{ route('home') }}" class="logo mx-auto"><img class="logo-size" src="{{ asset($logo) }}" alt="لوگو" /></a>
    </div>
    <hr>

    <ul class="generic-list-item off-canvas-menu-list pt-2 pb-2 border-bottom border-bottom-gray">
        <li>
            <a href="{{ route('home') }}">فکور</a>
        </li>
        <li>
            <a href="{{ route('courses') }}">دوره های آموزشی</a>
        </li>
        <li>
            <a href="{{route('articles',\App\Enums\ArticleEnum::ARTICLES)}}">مقالات </a>
        </li>
{{--        <li>--}}
{{--            <a href="{{route('articles',\App\Enums\ArticleEnum::NEWS)}}">اخبار </a>--}}
{{--        </li>--}}
        <li>
            <a href="{{route('cart')}}">سبد خرید </a>
        </li>
        <li>
            <a href="{{route('about')}}">درباره ما </a>
        </li>
        <li>
            <a href="{{route('contact')}}">ارتباط با ما </a>
        </li>
    </ul>
    @auth()
        <h2 class="off-canvas-menu-heading text-right pt-4">پنل کاربری</h2>
        <ul class="generic-list-item off-canvas-menu-list pt-2 pb-2 border-bottom border-bottom-gray">
            @role('admin')
            <li>
                <a href="{{route('admin.dashboard')}}">  مدیریت </a>
            </li>
            @endif
            <li>
                <a href="{{route('user.courses')}}">  دوره های من </a>
            </li>
            <li>
                <a href="{{route('user.quizzes')}}">  آزمون های من </a>
            </li>
            <li>
                <a href="{{route('user.dashboard')}}">  داشبورد </a>
            </li>
            <li>
                <a href="{{route('user.profile')}}">  پروفایل </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">  خروج </a>
            </li>
        </ul>
    @else
        <div class="btn-box px-4 pt-5 text-center">
            <a href="{{route('auth')}}" class="btn theme-btn theme-btn-sm theme-btn-transparent"><i class="la la-sign-in mr-1"></i>ورود </a>
            <span class="fs-15 font-weight-medium d-inline-block mx-2">یا</span>
            <a href="{{route('auth',['action'=>'register'])}}" class="btn theme-btn theme-btn-sm shadow-none"><i class="la la-plus mr-1"></i> ثبت نام</a>
        </div>
    @endif
</div>
