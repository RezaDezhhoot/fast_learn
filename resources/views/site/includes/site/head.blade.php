<head>
    @livewireStyles
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('site/library/plyr/plyr.css?v=1.0.1')}}">
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{asset($logo)}}" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/line-awesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/tooltipster.bundle.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/animated-headline.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/jdate/persianDatepicker-default.css') }}" />
    <!-- end inject -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>
