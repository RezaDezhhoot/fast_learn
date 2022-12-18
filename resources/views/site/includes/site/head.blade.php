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
{{--    <script src="https://cdn.plyr.io/3.6.12/plyr.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css" />--}}
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
    <script src="{{asset('site/js/alpine.min.js')}}" defer></script>
    <script src="{{asset('site/js/sweetalert2.js')}}" defer></script>

</head>
