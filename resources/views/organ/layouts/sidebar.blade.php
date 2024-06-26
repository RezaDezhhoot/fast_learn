<div class="aside aside-left d-flex aside-fixed" id="kt_aside">
    <!--begin::Primary-->
    <div class="aside-primary d-flex flex-column align-items-center flex-row-auto">
        <!--begin::Brand-->
        <div class="aside-brand d-flex flex-column align-items-center flex-column-auto py-5 py-lg-12">
            <!--begin::Logo-->
            <a href="{{ route('home') }}" class="brand-logo">
                <img alt="Logo" style="max-width: 4rem;" src="{{asset($logo)}}" />
            </a>
            <!--end::Logo-->
        </div>
        <!--end::Brand-->
        <!--begin::Nav Wrapper-->
        <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid py-5 scroll scroll-pull">
            <!--begin::Nav-->
            <ul class="nav flex-column" role="tablist">
                <!--begin::Item-->

                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="منو">
                    <a class="nav-link btn btn-icon btn-clean btn-lg active" data-toggle="tab" data-target="#kt_aside_tab_2" role="tab">
										<span class="svg-icon svg-icon-xl">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                    </a>
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Nav-->
        </div>
        <!--end::Nav Wrapper-->
        <!--begin::Footer-->
        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto py-4 py-lg-10">
            <!--begin::Aside Toggle-->
            <span class="aside-toggle btn btn-icon btn-primary btn-hover-primary shadow-sm" id="kt_aside_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="باز/بستن منو">
								<i class="ki ki-bold-arrow-back icon-sm"></i>
							</span>

            <a href="" class="btn btn-icon btn-clean btn-lg w-40px h-40px" id="kt_quick_user_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="پروفایل">
								<span class="symbol symbol-30 symbol-lg-40">
									<span class="svg-icon svg-icon-xl">
										<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24" />
												<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
											</g>
										</svg>
                                        <!--end::Svg Icon-->
									</span>
                                    <!--<span class="symbol-label font-size-h5 font-weight-bold">S</span>-->
								</span>
            </a>
            <!--end::User-->
        </div>
        <!--end::Footer-->
    </div>
    <!--end::Primary-->
    <!--begin::Secondary-->
    <div class="aside-secondary d-flex flex-row-fluid">
        <!--begin::Workspace-->
        <div class="aside-workspace scroll scroll-push my-2">
            <!--begin::Tab Content-->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-3 px-lg-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                                <li class="menu-item {{ url()->current() == route('organ.dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('organ.dashboard') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
													<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
                                        <!--end::Svg Icon-->
										</span>
                                        <span class="menu-text">داشبورد</span>
                                    </a>
                                </li>
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش شخصی</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                @role('admin')
                                    <x-organ.menu-item href="{{route('admin.dashboard')}}" icon="flaticon2-user" :active="request()->routeIs('admin.dashboard')" label="مدیریت" />
                                @endif
                                @role('teacher')
                                    <x-organ.menu-item href="{{route('teacher.dashboard')}}" icon="fas fa-chalkboard-teacher" :active="request()->routeIs('teacher.dashboard')" label="پنل مدرس" />
                                @endif
                                <x-organ.menu-item href="{{route('user.dashboard')}}" icon="flaticon2-user" :active="request()->routeIs('user.dashboard')" label="پنل کاربری" />
                                <x-organ.menu-item href="{{route('user.profile')}}" icon="flaticon2-user" :active="request()->routeIs('user.profile')" label="پروفایل" />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش رسانه</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-item href="{{route('fm.fm-button')}}" icon="flaticon2-file" :active="request()->routeIs('unisharp.lfm.show')" label="مدیریت رسانه ها" />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش محتوا</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-group icon="fab fa-product-hunt" :active="request()->routeIs(['organ.courses','organ.new.courses','organ.store.courses','organ.episodes','organ.store.episodes','organ.chapters','organ.store.chapters'])" label="دوره های اموزشی" >
                                    <x-organ.menu-item href="{{route('organ.courses')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['organ.courses','organ.new.courses'])" label="دروه ها  "  />
                                    <x-organ.menu-item href="{{route('organ.chapters')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['organ.chapters','organ.store.chapters'])" label="فصل ها  "  />
                                    <x-organ.menu-item href="{{route('organ.episodes')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['organ.episodes','organ.store.episodes'])" label="درس ها  " />
                                </x-organ.menu-group>
                                <x-organ.menu-item href="{{route('organ.samples')}}" icon="fa fa-question"  :active="request()->routeIs(['organ.samples','organ.store.samples'])" label="نمونه سوالات " />
                                <x-organ.menu-item href="{{route('organ.group')}}" icon="flaticon2-group"  :active="request()->routeIs(['organ.group','organ.store.group'])" label="گروه های اموزشی" />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش مالی</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-item href="{{route('organ.order')}}" icon="flaticon2-box"  :active="request()->routeIs(['organ.order'])" label="سفارش ها" />
                                <x-organ.menu-item  href="{{route('organ.checkouts')}}" icon="fmenu-icon fab fa-cc-amazon-pay" :active="request()->routeIs(['organ.checkouts','organ.store.checkouts'])" label=" تسویه حساب ها " />
                                <x-organ.menu-item  href="{{route('organ.bankAccounts')}}" icon="fa fa-piggy-bank" :active="request()->routeIs(['organ.bankAccounts','organ.store.bankAccounts'])" label=" حساب های بانکی " />

                                <li class="menu-section">
                                    <h4 class="menu-text">بخش گزارشات</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-item  href="{{route('organ.rollCall')}}" icon="flaticon2-list-1" :active="request()->routeIs(['organ.rollCall','organ.store.rollCall'])" label=" دفتر حضور غیاب "  />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش فنی</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-item href="{{route('organ.settings')}}" icon="flaticon2-settings" :active="request()->routeIs(['organ.settings','organ.store.settings'])" label="تنظیمات " />
                                <li class="menu-section">
                                    <h4 class="menu-text"> خروج</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-organ.menu-item href="{{route('logout')}}" icon="flaticon-logout" :active="request()->routeIs('logout')" label="خروج" />
                            </ul>
                            <!--end::Menu Nav-->
                        </div>
                        <!--end::Menu Container-->
                    </div>
                    <!--end::Aside Menu-->
                </div>
                <!--end::Tab Pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Workspace-->
    </div>
    <!--end::Secondary-->
</div>
