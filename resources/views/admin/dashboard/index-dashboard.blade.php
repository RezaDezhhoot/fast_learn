<div>
    @section('title','داشبورد')
    @if(auth()->user()->hasPermissionTo('show_dashboard'))
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">داشبورد</h5>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center justify-content-between">
                <!--begin::Actions-->
                <p class="m-0">از تاریخ</p>
                <div class="d-flex align-center justify-content-between">
                    <x-admin.forms.jdate-picker id="date" label=""   wire:model.defer="from_date_view"/>
                </div>
                <p class="m-0">تا تاریخ</p>
                <div>
                    <x-admin.forms.jdate-picker id="date2" label=""  wire:model.defer="to_date_viwe"/>
                </div>
                <div>
                    <button wire:loading.attr="disabled" class="btn btn-light-primary font-weight-bolder btn-sm" wire:click.prevent="confirmFilter">اعمال فیلتر</button>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
        <div class="card card-custom">
        <div class="card-body">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h4 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">گزارش کلی</span>
                    </h4>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <div class="card-header h-auto-0 p-0 border-0">
                <div class="card-title mt-3">
                    <h5 class="card-label">
                        <span class="d-block text-dark font-weight-bolder"> محتوا</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info flaticon2-list-1 fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['categories'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">دسته بندی</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x">
                                <i class="text-info fab fa-product-hunt fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['courses'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">دوره</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fas fa-text-height fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['articles'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">مقاله</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info far fa-question-circle fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['questions'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">سوال</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                             <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fas fa-pen-alt fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['quizzes'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">ازمون</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-2">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x">
                               <i class="text-info fas fa-certificate fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['certificates'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">گواهینامه</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
            </div>
            <div class="card-header h-auto-0 p-0 border-0">
                <div class="card-title mt-3">
                    <h5 class="card-label">
                        <span class="d-block text-dark font-weight-bolder"> کاربر</span>
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger fa fa-user-plus fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['all_users'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">کاربران</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-4">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger fab fa-first-order fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['all_orders'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">سفارش ها</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-4">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger fas fa-file-alt fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['all_transcripts'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">کارنامه های ثبت شده</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 py-2">
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h4 class="card-label">
                                <span class="d-block text-dark font-weight-bolder">گزارش بر حسب تاریخ</span>
                            </h4>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Page Heading-->
                    </div>
                </div>
                <x-admin.forms.select2 id="course" :data="$data['courses']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
                <div class="row p-0 m-0 w-100 d-flex justify-content-center">
                    <div class="col-md-4">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom bg-light-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Cooking\Cutting board.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M8.37867966,15.1213203 C9.35499039,16.0976311 9.35499039,17.6805435 8.37867966,18.6568542 L6.25735931,20.7781746 C5.28104858,21.7544853 3.69813614,21.7544853 2.72182541,20.7781746 C1.74551468,19.8018639 1.74551468,18.2189514 2.72182541,17.2426407 L4.84314575,15.1213203 C5.81945648,14.1450096 7.40236893,14.1450096 8.37867966,15.1213203 Z M3.81784105,19.7528699 C4.30599642,20.2410253 5.09745264,20.2410253 5.58560801,19.7528699 C6.07376337,19.2647145 6.07376337,18.4732583 5.58560801,17.9851029 C5.09745264,17.4969476 4.30599642,17.4969476 3.81784105,17.9851029 C3.32968569,18.4732583 3.32968569,19.2647145 3.81784105,19.7528699 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M14.3890873,1.33273811 L22.1672619,9.1109127 C22.9483105,9.89196129 22.9483105,11.1582912 22.1672619,11.9393398 L12.9748737,21.131728 C12.1938252,21.9127766 10.9274952,21.9127766 10.1464466,21.131728 L2.36827202,13.3535534 C1.58722343,12.5725048 1.58722343,11.3061748 2.36827202,10.5251263 L11.5606602,1.33273811 C12.3417088,0.551689527 13.6080387,0.551689527 14.3890873,1.33273811 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ $box['orders'] }}عدد
                            </span>
                                <span class="font-weight-bold text-dark font-size-lg">سفارش های تکمیل شده</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                    <div class="col-md-4">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom bg-light-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ number_format($box['payments']) }}تومان
                            </span>
                                <span class="font-weight-bold text-dark font-size-lg">مبالغ پرداخت شده</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                    <div class="col-md-4">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom bg-light-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ number_format($box['paymentsTeacher']) }}تومان
                            </span>
                                <span class="font-weight-bold text-dark font-size-lg">مبالغ حق التدریس </span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom bg-light-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ number_format($box['paymentsReduction']) }}تومان
                            </span>
                                <span class="font-weight-bold text-dark font-size-lg">مبالغ تخفیف خورده</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Stats Widget 25-->
                        <div class="card card-custom bg-light-success card-stretch gutter-b">
                            <!--begin::Body-->
                            <div class="card-body">
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{ number_format($box['paymentsWallet']) }}تومان
                            </span>
                                <span class="font-weight-bold text-dark font-size-lg">مبالغ کیف پول</span>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Stats Widget 25-->
                    </div>
                </div>
            </div>
            <div class="row" wire:ignore>
                <div class="col-xl-12" wire:init="runChart()">
                    <!--begin::Charts Widget 4-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header h-auto border-0">
                            <div class="card-title py-5">
                                <h3 class="card-label">
                                    <span class="d-block text-dark font-weight-bolder"> نمودار پرداخت هزینه بابت دوره های اموزشی</span>
                                </h3>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div id="kt_charts_widget_4_chart2"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Charts Widget 4-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!--begin::Stats Widget 26-->
                    <div class="card card-custom bg-light-danger card-stretch gutter-b">
                        <!--begin::ody-->
                        <div class="card-body">
												<span class="svg-icon svg-icon-4x svg-icon-danger">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<polygon points="0 0 24 0 24 24 0 24"></polygon>
															<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
															<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{$box['users'] }}عدد
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">کاربر جدید</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 26-->
                </div>
                <div class="col-md-6">
                    <!--begin::Stats Widget 26-->
                    <div class="card card-custom bg-light-danger card-stretch gutter-b">
                        <!--begin::ody-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-danger svg-icon-4x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
                                    <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{number_format($box['walletCharge']) }}تومان
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">بابت شارژ کیف پول</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 26-->
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12 table-responsive">
                    <h4 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">پرفروش ترین دوره ها</span>
                    </h4>
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>عنوان</th>
                            <th>تعداد فروش</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($most_sold as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->details_count }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.course',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="8">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-12 table-responsive">
                    <h4 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">اخرین واریزی های حق التدرسی</span>
                    </h4>
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>مدرس</th>
                            <th>واریزی</th>
                            <th>تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($fees as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->created_at_format }}</td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="5">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
    <script>
        Livewire.on('runChart', function (data) {
            const element = document.getElementById("kt_charts_widget_4_chart2");
            if (!element) {
                return;
            }
                const obj = JSON.parse(data);
            const options = {
                series: [{
                    name: 'پرداختی ها',
                    data: <?php echo "obj.payments" ?>
                }],
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: {
                        show: true
                    }
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: obj.label,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: KTApp.getSettings()['colors']['theme']['light']['success'],
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: false,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + " تومان"
                        }
                    }
                },
                colors: [
                    KTApp.getSettings()['colors']['theme']['base']['success'],
                ],
                grid: {
                    borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    colors: [
                        KTApp.getSettings()['colors']['theme']['light']['success'],
                    ],
                    strokeColor: [
                        KTApp.getSettings()['colors']['theme']['light']['success'],
                    ],
                    strokeWidth: 3
                }
            };

            const chart = new ApexCharts(element, options);
            throw chart.render();
        });
    </script>
@endpush
