<!DOCTYPE html>
<html lang="fa">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="جان دئو" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>{{ $site_title }}</title>

    <!-- Google fonts -->

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />

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
    <!-- end inject -->
</head>
<body>
<!-- ================================
START ERROR AREA
================================= -->
<section class="error-area section--padding dot-bg overflow-hidden">
    <div class="container">
        <div class="col-lg-7 mx-auto">
            <div class="error-content text-center">
                <svg viewBox="0 -35 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m442 232.910156v-205.410156c0-15.164062-12.335938-27.5-27.5-27.5h-387c-15.164062 0-27.5 12.335938-27.5 27.5v311c0 15.164062 12.335938 27.5 27.5 27.5h39.167969c4.140625 0 7.5-3.359375 7.5-7.5s-3.359375-7.5-7.5-7.5h-39.167969c-6.894531 0-12.5-5.605469-12.5-12.5v-270.5h412v160.472656c-7.414062-1.613281-15.109375-2.472656-23-2.472656-20.28125 0-39.269531 5.621094-55.5 15.386719v-84.386719c0-4.140625-3.355469-7.5-7.5-7.5s-7.5 3.359375-7.5 7.5v53h-42.5c-1.378906 0-2.5-1.121094-2.5-2.5v-50.5c0-4.140625-3.355469-7.5-7.5-7.5s-7.5 3.359375-7.5 7.5v50.5c0 9.648438 7.851562 17.5 17.5 17.5h42.5v26.695312c0 .179688.015625.355469.027344.53125-19.871094 17.152344-33.441406 41.402344-36.742188 68.773438h-251.785156v-223h352v100.5c0 4.140625 3.355469 7.5 7.5 7.5s7.5-3.359375 7.5-7.5v-103c0-6.894531-5.605469-12.5-12.5-12.5h-357c-6.894531 0-12.5 5.605469-12.5 12.5v228c0 6.894531 5.605469 12.5 12.5 12.5h253.523438c.09375 5.09375.539062 10.101562 1.320312 15h-195.675781c-4.144531 0-7.5 3.359375-7.5 7.5s3.355469 7.5 7.5 7.5h199.171875c13.671875 43.976562 54.746094 76 103.160156 76 59.550781 0 108-48.449219 108-108 0-46.183594-29.140625-85.683594-70-101.089844zm-427-179.910156v-25.5c0-6.894531 5.605469-12.5 12.5-12.5h387c6.894531 0 12.5 5.605469 12.5 12.5v25.5zm389 374c-51.28125 0-93-41.71875-93-93s41.71875-93 93-93 93 41.71875 93 93-41.71875 93-93 93zm0 0"
                    ></path>
                    <path d="m44 25c-4.964844 0-9 4.039062-9 9s4.035156 9 9 9 9-4.039062 9-9-4.035156-9-9-9zm0 0"></path>
                    <path d="m82 25c-4.964844 0-9 4.039062-9 9s4.035156 9 9 9 9-4.039062 9-9-4.035156-9-9-9zm0 0"></path>
                    <path d="m120 25c-4.964844 0-9 4.039062-9 9s4.035156 9 9 9 9-4.039062 9-9-4.035156-9-9-9zm0 0"></path>
                    <path
                        d="m161 270.5c4.144531 0 7.5-3.359375 7.5-7.5v-106c0-4.140625-3.355469-7.5-7.5-7.5s-7.5 3.359375-7.5 7.5v53h-42.5c-1.378906 0-2.5-1.121094-2.5-2.5v-50.5c0-4.140625-3.355469-7.5-7.5-7.5s-7.5 3.359375-7.5 7.5v50.5c0 9.648438 7.851562 17.5 17.5 17.5h42.5v38c0 4.140625 3.355469 7.5 7.5 7.5zm0 0"
                    ></path>
                    <path
                        d="m201 150c-9.648438 0-17.5 7.851562-17.5 17.5v85c0 9.648438 7.851562 17.5 17.5 17.5h40c9.648438 0 17.5-7.851562 17.5-17.5v-85c0-9.648438-7.851562-17.5-17.5-17.5zm42.5 17.5v85c0 1.378906-1.121094 2.5-2.5 2.5h-40c-1.378906 0-2.5-1.121094-2.5-2.5v-85c0-1.378906 1.121094-2.5 2.5-2.5h40c1.378906 0 2.5 1.121094 2.5 2.5zm0 0"
                    ></path>
                    <path d="m221 187.5c-4.144531 0-7.5 3.359375-7.5 7.5v30c0 4.140625 3.355469 7.5 7.5 7.5s7.5-3.359375 7.5-7.5v-30c0-4.140625-3.355469-7.5-7.5-7.5zm0 0"></path>
                    <path d="m360.5 306.175781c-4.144531 0-7.5 3.359375-7.5 7.5v23c0 4.140625 3.355469 7.5 7.5 7.5s7.5-3.359375 7.5-7.5v-23c0-4.140625-3.355469-7.5-7.5-7.5zm0 0"></path>
                    <path d="m447.5 306.175781c-4.144531 0-7.5 3.359375-7.5 7.5v23c0 4.140625 3.355469 7.5 7.5 7.5s7.5-3.359375 7.5-7.5v-23c0-4.140625-3.355469-7.5-7.5-7.5zm0 0"></path>
                    <path
                        d="m404 347.175781c-11.722656 0-22.609375 5.289063-29.871094 14.507813-2.5625 3.253906-2 7.96875 1.253906 10.53125 3.253907 2.5625 7.972657 2.003906 10.53125-1.25 4.398438-5.585938 10.988282-8.789063 18.085938-8.789063s13.6875 3.203125 18.085938 8.789063c1.480468 1.878906 3.679687 2.859375 5.898437 2.859375 1.621094 0 3.257813-.523438 4.632813-1.605469 3.253906-2.5625 3.816406-7.277344 1.253906-10.535156-7.257813-9.21875-18.144532-14.507813-29.871094-14.507813zm0 0"
                    ></path>
                </svg>
                <div class="section-heading">
                    <h3 class="section__title pb-3"> احتمالا خطای به وجود اماده است</h3>
                </div>
                <div class="btn-box pt-30px">
                    <a href="{{ route('home') }}" class="btn theme-btn"><i class="la la-reply mr-1"></i> بازگشت به خانه</a>
                </div>
            </div>
            <!-- end error-content -->
        </div>
        <!-- end col-lg-7 -->
    </div>
    <!-- end container -->
</section>
<!-- end error-area -->
<!-- ================================
START ERROR AREA
================================= -->

<!-- template js files -->
<script src="{{ asset('site/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/isotope.js') }}"></script>
<script src="{{ asset('site/js/waypoint.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('site/js/fancybox.js') }}"></script>
<script src="{{ asset('site/js/jquery.lazy.min.js') }}"></script>
{{--<script src="{{ asset('site/js/datedropper.min.js') }}}"></script>--}}
<script src="{{ asset('site/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('site/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('site/js/main.js') }}"></script>
</body>
</html>
