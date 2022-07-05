<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('certificate.layouts.head')
<body>
    <div>
        @yield('content')
    </div>
    @livewireScripts
    @stack('scripts')
</body>
</html>
