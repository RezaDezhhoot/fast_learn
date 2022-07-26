<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">دوره های من</h3>
        </div>
        <div class="dashboard-cards mb-5">
            @forelse($courses as $item)
                <div class="card card-item card-item-list-layout mb-2">
                <!-- end card-image -->
                <div class="card-body d-flex align-items-center">
                    <p class="card-text px-2">کد سفارش : <a>{{ $item->tracking_code }}</a></p>
                    <h5 class="card-title"><a href="{{ route('course',['slug'=>$item->course->slug]) }}">{{ $item->course->title }}</a></h5>
                   
                    <p class="card-text px-2"><a>{{ $item->course->type_label }}</a></p>
                    <!-- end rating-wrap -->
                    <div class="d-flex justify-content-between align-items-center px-4">
                        <div class="card-action-wrap pl-3">
                            <a href="{{ route('course',['slug'=>$item->course->slug]) }}" class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-success" data-toggle="tooltip" data-placement="top" data-title="مشاهده">
                                <i class="la la-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            @empty
                <div class="custom-box-shadow d-flex align-items-center justify-content-center alert alert-info">
                    <p>
                        شماره هنوز در دوره ای ثبت نام نکرده ایا.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
