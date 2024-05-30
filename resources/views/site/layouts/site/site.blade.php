<!DOCTYPE html>
<html lang="fa">
    <livewire:site.includes.site.head/>
    <body>
        <livewire:site.includes.site.header/>
        @yield('content')
        <livewire:site.includes.site.footer/>
        <div id="scroll-top">
            <i class="la la-arrow-up" title="برو بالا"></i>
        </div>
    </body>
    @include('site.includes.site.foot')
</html>
