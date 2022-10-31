<div id="kt_quick_user" class="offcanvas offcanvas-left p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">پروفایل کاربر
            <small class="text-muted font-size-sm ml-2"></small></h3>
        <a class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <h5>موجودی حساب : {{ number_format(auth()->user()->balance) }} تومان </h5>
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('{{asset(auth()->user()->image)}}')"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="{{ route('admin.profile') }}" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {{ auth()->user()->name }}
                </a>
                <strong>کد کاربری : {{ auth()->id() }}</strong>
                <div class="text-muted mt-1">
                    @foreach(auth()->user()->roles as $item)
                        {!!  $item->name."<br>" !!}
                    @endforeach
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <div>
            <!--begin:Heading-->
            <h5 class="mb-5">اخرین اعلان ها</h5>
            <!--end:Heading-->
            <!--begin::Item-->
            @foreach(auth()->user()->alerts->sortByDesc('id') as $item)
                <div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">
						<span class="svg-icon svg-icon-warning mr-5">
							<span class="svg-icon svg-icon-lg">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
										<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
						</span>
                    <div class="d-flex flex-column flex-grow-1 mr-2">
                        <a class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">
                            {!! $item->content !!}
                        </a>
                        <span class="text-muted font-size-sm">
                            {{ $item->created_at->diffforhumans() }}
                        </span>
                    </div>
                </div>
            @endforeach

            <!--end::Item-->
        </div>
        <!--end::Notifications-->
    </div>
    <!--end::Content-->
</div>
