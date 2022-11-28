<div class="off-canvas-menu dashboard-off-canvas-menu off--canvas-menu custom-scrollbar-styled pt-20px">
    <div class="off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="right" title="بستن منو">
        <i class="la la-times"></i>
    </div>
    <!-- end off-canvas-menu-close -->
    <div class="logo-box px-4">
        <a href="{{ route('home') }}" class="logo "><img class="logo-size" src="{{ asset($logo) }}" alt="لوگو" /></a>
    </div>
    <ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
        <x-site.client.sidebar-link title="داشبورد" link="{{ route('user.dashboard') }}" icon="la la-dashboard pr-2" :active="request()->routeIs('user.dashboard')" />
        @role('admin')
            <x-site.client.sidebar-link title="پنل مدیریت" link="{{ route('admin.dashboard') }}" icon="la la-user-circle pr-2" :active="request()->routeIs('admin.dashboard')" />
        @endif
        <x-site.client.sidebar-link title=" پروفایل من" link="{{ route('user.profile') }}" icon="la la-user pr-2" :active="request()->routeIs('user.profile')" />
        <x-site.client.sidebar-link title=" دوره های من" link="{{ route('user.courses') }}" icon="la la-file pr-2" :active="request()->routeIs('user.courses')" />
        <x-site.client.sidebar-link title=" ازموان های من" link="{{ route('user.quizzes') }}" icon="la la-pen pr-2" :active="request()->routeIs(['user.quizzes','user.quiz','user.exam'])" />
        <x-site.client.sidebar-link title=" گواهینامه ها" link="{{ route('user.certificates') }}" icon="la la-certificate pr-2" :active="request()->routeIs(['user.certificates','user.certificate'])" />
        <x-site.client.sidebar-link title=" پرسش های من" link="{{ route('user.comments') }}" icon="la la-comment pr-2" :active="request()->routeIs('user.comments')" />
        <x-site.client.sidebar-link title="نمونه سوالات من" link="{{ route('user.sample') }}" icon="la la-question pr-2" :active="request()->routeIs(['user.sample'])" />
        {{-- <x-site.client.sidebar-link title=" تمرین های من" link="{{ route('user.homeworks') }}" icon="la la-file-archive pr-2" :active="request()->routeIs('user.homeworks')" /> --}}
        <x-site.client.sidebar-link title=" پیام ها" link="{{ route('user.notifications') }}" icon="la la-bell pr-2" :active="request()->routeIs('user.notifications')" />
        <x-site.client.sidebar-link title="ارسال مدارک" link="{{ route('user.tickets') }}" icon="la la-support pr-2" :active="request()->routeIs(['user.tickets','user.ticket'])" />
        <x-site.client.sidebar-link title="خروج" link="{{ route('logout') }}" icon="la la-power-off pr-2" :active="request()->routeIs('logout')" />
    </ul>
</div>
