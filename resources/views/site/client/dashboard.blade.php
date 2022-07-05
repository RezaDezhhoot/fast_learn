<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between mb-3">
            <div class="media media-card align-items-center">
                <div class="media-img media--img media-img-md rounded-full">
                    <img class="rounded-full" src="{{ asset(auth()->user()->image) }}" alt="تصویر کاربر" />
                </div>
                <div class="media-body">
                    <h2 class="section__title fs-30">سلام، {{ auth()->user()->name }}</h2>
                    <!-- end rating-wrap -->
                </div>
                <!-- end media-body -->
            </div>
            <!-- end media -->
            <!-- file-upload-wrap -->
        </div>
        <!-- end breadcrumb-content -->
        <div class="section-block mb-3"></div>
        <div class="dashboard-heading mb-3">
            <h3 class="fs-22 font-weight-semi-bold">داشبورد</h3>
        </div>
        <div class="row">
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element flex-shrink-0 bg-1 text-white">
                            <svg class="svg-icon-color-white" width="40" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                            <g>
                                                <path
                                                    d="M507.606,422.754l-86.508-86.508l42.427-42.426c3.676-3.676,5.187-8.993,3.992-14.053s-4.923-9.14-9.855-10.784   L203.104,184.13c-5.389-1.797-11.333-0.394-15.35,3.624c-4.018,4.018-5.421,9.96-3.624,15.35l84.853,254.559   c1.645,4.932,5.725,8.661,10.784,9.855c5.059,1.197,10.377-0.315,14.053-3.992l42.427-42.426l86.508,86.507   c2.929,2.929,6.768,4.394,10.606,4.394s7.678-1.464,10.606-4.394l63.64-63.64C513.465,438.109,513.465,428.612,507.606,422.754z    M433.36,475.787l-86.508-86.507c-5.857-5.858-15.356-5.858-21.213,0l-35.871,35.871l-67.691-203.073l203.073,67.691   l-35.871,35.871c-5.853,5.852-5.858,15.356,0,21.213l86.508,86.508L433.36,475.787z"
                                                ></path>
                                                <path d="M195,120c8.284,0,15-6.716,15-15V15c0-8.284-6.716-15-15-15s-15,6.716-15,15v90C180,113.284,186.716,120,195,120z"></path>
                                                <path
                                                    d="M78.327,57.114c-5.857-5.858-15.355-5.858-21.213,0c-5.858,5.858-5.858,15.355,0,21.213l63.64,63.64   c5.857,5.858,15.356,5.858,21.213,0c5.858-5.858,5.858-15.355,0-21.213L78.327,57.114z"
                                                ></path>
                                                <path
                                                    d="M120.754,248.033l-63.64,63.64c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.858,15.356,5.858,21.213,0l63.64-63.64   c5.858-5.858,5.858-15.355,0-21.213C136.109,242.175,126.611,242.175,120.754,248.033z"
                                                ></path>
                                                <path
                                                    d="M269.246,141.967l63.64-63.64c5.858-5.858,5.858-15.355,0-21.213c-5.857-5.858-15.355-5.858-21.213,0l-63.64,63.64   c-5.858,5.858-5.858,15.355,0,21.213C253.89,147.825,263.389,147.825,269.246,141.967z"
                                                ></path>
                                                <path d="M120,195c0-8.284-6.716-15-15-15H15c-8.284,0-15,6.716-15,15s6.716,15,15,15h90C113.284,210,120,203.284,120,195z"></path>
                                            </g>
                                        </svg>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">دوره های ثبت نام شده</p>
                            <h5 class="card-title pt-2 fs-26">{{ $myCourses }}</h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element d-flex align-items-center justify-content-center flex-shrink-0 bg-2 text-white">
                            <i class="la la-pen"></i>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">ازمون های اماده</p>
                            <h5 class="card-title pt-2 fs-26">{{ $myQuizzes }}</h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element d-flex align-items-center justify-content-center flex-shrink-0 bg-3 text-white">
                            <i class="la la-wallet"></i>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">موجودی کیف پول شما</p>
                            <h5 class="card-title pt-2 fs-26">{{ number_format($user->balance) }} تومان </h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element d-flex align-items-center justify-content-center flex-shrink-0 bg-4 text-white">
                            <i class="la la-certificate"></i>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">گواهینامه های شما</p>
                            <h5 class="card-title pt-2 fs-26">{{ number_format(auth()->user()->certificates->count()) }}</h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element d-flex align-items-center justify-content-center flex-shrink-0 bg-5 text-white">
                            <i class="la la-comment"></i>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">پرسش و پاسخ</p>
                            <h5 class="card-title pt-2 fs-26">{{ number_format(auth()->user()->comments_count) }}</h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-lg-4 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-element d-flex align-items-center justify-content-center flex-shrink-0 bg-6 text-white">
                            <i class="la la-user-cog"></i>
                        </div>
                        <div class="pl-4">
                            <p class="card-text fs-18">نقش</p>
                            <h5 class="card-title pt-2 fs-26">
                                @role('admin')
                                مدیر
                                @elseif(auth()->user()->is_teacher)
                                    مدرس
                                @else
                                    کاربر عادی
                                @endif
                            </h5>
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-12 responsive-column-half">
                <div class="card card-item dashboard-info-card">
                    <div class="card-body">
                        <div class="pl-4">
                            <p class="card-text fs-18">جدیدترین اعلان ها</p>
                            <h5 class="card-title pt-2 fs-26">
                                @foreach($notifications as $item)
                                    <div class="border rounded p-2 my-3 custom-box-shadow" >
                                        <small class="fs-11"> {{ $item->date }} </small>
                                        <div class="py-3 fs-14">{!! $item->content  !!}</div>
                                    </div>
                                @endforeach
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
