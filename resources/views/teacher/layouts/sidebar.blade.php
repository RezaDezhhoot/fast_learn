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
                <li class="nav-item mb-3" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="اخرین فعالیت ها">
                    <a class="nav-link btn btn-icon btn-clean btn-lg " data-toggle="tab" data-target="#kt_aside_tab_1" role="tab">
										<span class="svg-icon svg-icon-xl">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
													<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                    </a>
                </li>
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
            <a href="" class="btn btn-icon btn-clean btn-lg mb-1" id="kt_quick_actions_toggle" data-toggle="tooltip" data-placement="right" data-container="body" data-boundary="window" title="دسترسی سریع">
								<span class="svg-icon svg-icon-xl">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24" />
											<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
											<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
											<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
											<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
										</g>
									</svg>
                                    <!--end::Svg Icon-->
								</span>
            </a>
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
                <!--begin::Tab Pane-->
                <div class="tab-pane p-3 px-lg-7 py-lg-5 fade  " id="kt_aside_tab_1">
                    <h3 class="p-2 p-lg-3 my-1 my-lg-3">اخرین فعالیت ها</h3>
                    <!--begin::List-->
                    <div class="list list-hover">
                        @forelse(auth()->user()->last_activities as $item)
                            <a href="{{$item->url}}" class="d-block">
                                <div class="list-item hoverable p-2 p-lg-3 mb-2">
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light mr-4">
													<span class="symbol-label bg-hover-white">
														<i class="{{$item->icon}} text-info"></i>
													</span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Text-->
                                        <div class="d-flex flex-column flex-grow-1 mr-2">
                                            <span class="text-dark-75 font-size-h6 mb-0">{{$item->subject}}</span>
                                            <span class="text-muted text-hover-primary font-weight-bold">{{$item->created_at}}</span>
                                        </div>
                                        <!--begin::End-->
                                    </div>
                                </div>
                            </a>
                        @empty
                        @endforelse
                    </div>
                    <!--end::List-->
                </div>
                <!--end::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane fade show active" id="kt_aside_tab_2">
                    <!--begin::Aside Menu-->
                    <div class="aside-menu-wrapper flex-column-fluid px-3 px-lg-10 py-5" id="kt_aside_menu_wrapper">
                        <!--begin::Menu Container-->
                        <div id="kt_aside_menu" class="aside-menu min-h-lg-800px" data-menu-vertical="1" data-menu-scroll="1">
                            <!--begin::Menu Nav-->
                            <ul class="menu-nav">
                                <li class="menu-item {{ url()->current() == route('teacher.dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('teacher.dashboard') }}" class="menu-link">
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
                                    <x-teacher.menu-item href="{{route('admin.dashboard')}}" icon="flaticon2-user" :active="request()->routeIs('admin.dashboard')" label="مدیریت" />
                                @endif
                                <x-teacher.menu-item href="{{route('user.dashboard')}}" icon="flaticon2-user" :active="request()->routeIs('user.dashboard')" label="پنل کاربری" />
                                <x-teacher.menu-item href="{{route('user.profile')}}" icon="flaticon2-user" :active="request()->routeIs('user.profile')" label="پروفایل" />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش رسانه</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-teacher.menu-item href="{{route('fm.fm-button')}}" icon="flaticon2-file" :active="request()->routeIs('unisharp.lfm.show')" label="مدیریت رسانه ها" />
                                <li class="menu-section">
                                    <h4 class="menu-text"> بخش ازمون و سوالات (به زودی)</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
{{--                                <x-teacher.menu-item href="{{route('teacher.questions')}}" icon="far fa-question-circle" :active="request()->routeIs(['teacher.questions','teacher.store.questions'])" label="سوالات " />--}}
{{--                                <x-teacher.menu-item href="{{route('teacher.quizzes')}}" icon="fas fa-pen-alt" :active="request()->routeIs(['teacher.quizzes','teacher.store.quizzes'])" label="ازمون ها " />--}}
{{--                                <x-teacher.menu-item href="{{route('teacher.transcripts')}}" icon="flaticon2-paper" :active="request()->routeIs(['teacher.transcripts','teacher.store.transcripts'])" label="کارنامه ها" />--}}
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش محتوا</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-teacher.menu-group icon="fab fa-product-hunt" :active="request()->routeIs(['teacher.courses','teacher.new.courses','teacher.store.courses','teacher.episodes','teacher.store.episodes'])" label="دوره های اموزشی" >
                                    <x-teacher.menu-item href="{{route('teacher.courses')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['teacher.courses','teacher.new.courses'])" label="دروه ها  " :new="$new_courses" />
                                    <x-teacher.menu-item href="{{route('teacher.episodes')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['teacher.episodes','teacher.store.episodes'])" label="درس ها  " />
                                </x-teacher.menu-group>
                                <x-teacher.menu-item href="{{route('teacher.samples')}}" icon="fa fa-question"  :active="request()->routeIs(['teacher.samples','teacher.store.samples'])" label="نمونه سوالات " />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش ارتباطی</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-teacher.menu-item  href="{{route('teacher.comments')}}" icon="fa fa-comment-alt" :active="request()->routeIs(['teacher.comments','teacher.store.comments'])" label="کامنت ها "  />
                                <li class="menu-section">
                                    <h4 class="menu-text">بخش مالی</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md  "></i>
                                </li>
                                <x-teacher.menu-item  href="{{route('teacher.checkouts')}}" icon="fmenu-icon fab fa-cc-amazon-pay" :active="request()->routeIs(['teacher.checkouts','teacher.store.checkouts'])" label=" تسویه حساب ها " />
                                <x-teacher.menu-item  href="{{route('teacher.bankAccounts')}}" icon="fa fa-piggy-bank" :active="request()->routeIs(['teacher.bankAccounts','teacher.store.bankAccounts'])" label=" حساب های بانکی " />
                                <li class="menu-section">
                                    <h4 class="menu-text"> خروج</h4>
                                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                                </li>
                                <x-teacher.menu-item href="{{route('logout')}}" icon="flaticon-logout" :active="request()->routeIs('logout')" label="خروج" />
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
