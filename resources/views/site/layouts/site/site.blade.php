<!DOCTYPE html>
<html lang="fa">
    <livewire:site.includes.site.head/>
    <body>
{{--        <div class="preloader">--}}
{{--            <div class="loader">--}}
{{--                <svg class="spinner" viewBox="0 0 50 50">--}}
{{--                    <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--        </div>--}}
        <livewire:site.includes.site.header/>
        @yield('content')
        <livewire:site.includes.site.footer/>
        <div id="scroll-top">
            <i class="la la-arrow-up" title="برو بالا"></i>
        </div>
    </body>
    @include('site.includes.site.foot')
</html>
