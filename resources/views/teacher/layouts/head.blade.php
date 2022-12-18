<head>
    <base href="">
    <meta charset="utf-8" />
    <title>  پنل مدرس - @yield('title') </title>
    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{asset('teacher/plugins/custom/datepicker/persian-datepicker.min.css')}}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('teacher/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('teacher/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('teacher/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('teacher/css/style.bundle.rtl.cs')}}s" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="{{ asset($logo) }}">
    <script src="{{asset('admin/js/alpine.min.js')}}" defer></script>
    <script src="{{asset('admin/js/jquery.min.js')}}" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">--}}

    <style>
        .table-responsive {
            overflow-x:auto;
        }
    </style>
</head>
