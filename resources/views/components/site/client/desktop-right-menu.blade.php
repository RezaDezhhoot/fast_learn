<li>
    <div class="shop-cart-btn">
        <div class="avatar-xs">
            @if(auth()->user()->image)
                <img class="rounded-full img-fluid h-100" src="{{asset(auth()->user()->image)}}" alt="" />
            @else
                <img class="rounded-full img-fluid h-100" src="{{asset('site/images/icons8-user-30.png')}}" alt="" />
            @endif
        </div>
        <span class="dot-status bg-1"></span>
    </div>
    <ul class="cart-dropdown-menu after-none p-0 notification-dropdown-menu">
        <li class="menu-heading-block d-flex align-items-center">
            <a class="avatar-sm flex-shrink-0 d-block">
                <img class="rounded-full img-fluid h-100" src="{{asset(auth()->user()->image)}}" alt="" />
            </a>
            <div class="ml-2">
                <h4><a class="text-black">{{ auth()->user()->name }}</a></h4>
                <span class="d-block fs-14 lh-20">{{ auth()->user()->email }}</span>
            </div>
        </li>
        <li>
            <ul class="generic-list-item">
                @role('admin')
                <li>
                    <a href="{{route('admin.dashboard')}}"> <i class="la la-gears"></i> مدیریت </a>
                </li>
                @endif
                <li>
                    <a href="{{route('user.courses')}}"> <i class="la la-file-video-o mr-1"></i> دوره های من </a>
                </li>
                <li>
                    <a href="{{route('user.dashboard')}}"> <i class="la la-dashboard mr-1"></i> داشبورد </a>
                </li>
                <li>
                    <a href="{{route('user.sample')}}"> <i class="la la-question mr-1"></i> نمونه سوالات من </a>
                </li>
                <li>
                    <a href="{{route('user.profile')}}"> <i class="la la-gear mr-1"></i> پروفایل </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"> <i class="la la-power-off mr-1"></i> خروج </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
