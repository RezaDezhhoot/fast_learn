<!--begin::Aside-->
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
        <!--begin::Logo-->
        <a href="{{ route('home') }}" class="brand-logo">
            <img alt="Logo" style="max-width: 4rem;" src="{{asset($logo)}}" />
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
                                <!--end::Svg Icon-->
							</span>
        </button>
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ url()->current() == route('admin.dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
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
                <x-admin.menu-item href="{{route('admin.profile')}}" icon="flaticon2-user" :active="request()->routeIs('admin.profile')" label="پروفایل" />
                <x-admin.menu-item href="{{route('user.dashboard')}}" icon="flaticon2-user" :active="request()->routeIs('user.dashboard')" label="پنل کاربری" />
                @if (auth()->user()->organs)
                    <x-admin.menu-item href="{{route('organ.dashboard')}}" icon="fas fa-building" :active="request()->routeIs('organ.dashboard')" label="پنل اموزشگاه" />
                @endif
                @role('teacher')
                    <x-admin.menu-item href="{{route('teacher.dashboard')}}" icon="fas fa-chalkboard-teacher" :active="request()->routeIs('teacher.dashboard')" label="پنل مدرس" />
                @endif
                <li class="menu-section">
                    <h4 class="menu-text">بخش رسانه</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <x-admin.menu-item href="{{route('fm.fm-button')}}" icon="flaticon2-file" :active="request()->routeIs('unisharp.lfm.show')" label="مدیریت رسانه ها" />
                <li class="menu-section">
                    <h4 class="menu-text">بخش ازمون و گواهینامه</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_questions')
                    <x-admin.menu-item href="{{route('admin.question')}}" icon="far fa-question-circle" :active="request()->routeIs(['admin.question','admin.store.question'])" label="سوالات " />
                @endcan
                @can('show_quizzes')
                    <x-admin.menu-item href="{{route('admin.quiz')}}" icon="fas fa-pen-alt" :active="request()->routeIs(['admin.quiz','admin.store.quiz'])" label="ازمون ها " />
                @endcan
                @can('show_certificates')
                    <x-admin.menu-item href="{{route('admin.certificate')}}" icon="fas fa-certificate" :active="request()->routeIs(['admin.certificate','admin.store.certificate'])" label="گواهینامه ها  " />
                @endcan
                @can('show_transcripts')
                    <x-admin.menu-item href="{{route('admin.transcript')}}" icon="flaticon2-paper" :active="request()->routeIs(['admin.transcript','admin.store.transcript'])" label="کارنامه ها" />
                @endcan
                <li class="menu-section">
                    <h4 class="menu-text">بخش مدرسین</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_teachers')
                    <x-admin.menu-item href="{{route('admin.teacher')}}" icon="fas fa-chalkboard-teacher" :active="request()->routeIs(['admin.teacher','admin.store.teacher'])" label="مدرسین" />
                @endcan
                {{-- v3-teacher-requests --}}
                @can('show_teacher_requests')
                    <x-admin.menu-item  href="{{route('admin.request')}}" icon="fas fa-chalkboard-teacher" :active="request()->routeIs(['admin.request','admin.store.request'])" label=" درخواست های مدرس جدید ({{$new_teachers}})" />
                @endcan

                <li class="menu-section">
                    <h4 class="menu-text">بخش محتوا</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_categories')
                    <x-admin.menu-item href="{{route('admin.category')}}" icon="flaticon2-list-1" :active="request()->routeIs(['admin.category','admin.store.category'])" label="دسته بندی ها " />
                @endcan
                @can('show_tags')
                    <x-admin.menu-item href="{{route('admin.tag')}}" icon="fas fa-tag" :active="request()->routeIs(['admin.tag','admin.store.tag'])" label="تگ ها" />
                @endcan
                @if(auth()->user()->hasAnyPermission('show_courses','show_episodes','show_new_courses','show_chapters'))
                    <x-admin.menu-group icon="fab fa-product-hunt" :active="request()->routeIs(
                    ['admin.course','admin.store.course','admin.episode','admin.store.episode',
                    'admin.newCourse','admin.store.newCourse','admin.episodeTranscript',
                    'admin.store.episodeTranscript','admin.chapter','admin.store.chapter','admin.chapterTranscript','admin.store.chapterTranscript'])" label="دوره های اموزشی" >
                        @can('show_courses')
                            <x-admin.menu-item href="{{route('admin.course')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.course','admin.store.course'])" label="دروه ها  " />
                        @endcan
                            @can('show_chapters')
                                <x-admin.menu-item href="{{route('admin.chapter')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.chapter','admin.store.chapter'])" label="فصل ها  " />
                                <x-admin.menu-item href="{{route('admin.chapterTranscript')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.chapterTranscript','admin.store.chapterTranscript'])" label=" رونوشت های ارسالی فصل ها ({{$chapter_transcripts}})  " />
                            @endcan
                        @can('show_episodes')
                            <x-admin.menu-item href="{{route('admin.episode')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.episode','admin.store.episode'])" label="درس ها  " />
                            <x-admin.menu-item href="{{route('admin.episodeTranscript')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.episodeTranscript','admin.store.episodeTranscript'])" label=" رونوشت های ارسالی درس ها ({{$episode_transcripts}})  " />
                        @endcan
                            {{-- v3-new-courses --}}
                            @can('show_new_courses')
                                <x-admin.menu-item href="{{route('admin.newCourse')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.newCourse','admin.store.newCourse'])" label="دروه های جدید ({{$new_courses}})" />
                            @endcan
                    </x-admin.menu-group>
                @endif
                @can('show_articles')
                    <x-admin.menu-item href="{{route('admin.article')}}" icon="fas fa-text-height"  :active="request()->routeIs(['admin.article','admin.store.article'])" label="مقالات " />
                @endcan

                {{-- v2-samples --}}
                @can('show_samples')
                    <x-admin.menu-item href="{{route('admin.sample')}}" icon="fa fa-question"  :active="request()->routeIs(['admin.sample','admin.store.sample'])" label="نمونه سوالات " />
                @endcan
                @can('show_groups')
                    <x-admin.menu-item href="{{route('admin.group')}}" icon="flaticon2-group"  :active="request()->routeIs(['admin.group','admin.store.group'])" label="گروه های اموزشی" />
                @endcan
                <li class="menu-section">
                    <h4 class="menu-text">بخش ارتباطی</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_events')
                    <x-admin.menu-item href="{{route('admin.event')}}" icon="fa fa-clock" :active="request()->routeIs(['admin.event','admin.store.event'])" label="رویداد ها " />
                @endcan
                @can('show_tickets')
                    <x-admin.menu-item href="{{route('admin.ticket')}}" icon="fas fa-ticket-alt" :active="request()->routeIs(['admin.ticket','admin.store.ticket'])" label="تیکت ها ({{$tickets}})" />
                @endcan
                @can('show_notifications')
                    <x-admin.menu-item  href="{{route('admin.notification')}}" icon="flaticon2-notification" :active="request()->routeIs(['admin.notification','admin.store.notification'])" label="اعلان ها" />
                @endcan
                @can('show_comments')
                    <x-admin.menu-item  href="{{route('admin.comment')}}" icon="fa fa-comment-alt" :active="request()->routeIs(['admin.comment','admin.store.comment'])" label="کامنت ها ({{$comments}})"  />
                @endcan
                @can('show_contacts')
                    <x-admin.menu-item  href="{{route('admin.contact')}}" icon="flaticon-email" :active="request()->routeIs(['admin.contact','admin.store.contact'])" label=" ارتباط با ما ({{$contacts}})" />
                @endcan
                @can('show_contacts')
                    <x-admin.menu-item  href="{{route('admin.report.violation')}}" icon="flaticon-warning" :active="request()->routeIs(['admin.report.violation'])" label="گزارش تخلفات ({{$violations}})" />
                @endcan
                @can('show_forms')
                    <x-admin.menu-item href="{{route('admin.answer')}}" icon="flaticon2-writing" :active="request()->routeIs(['admin.answer','admin.store.answer'])" label="فرم های ارسالی ({{$forms}})" />
                @endcan
                <li class="menu-section ">
                    <h4 class="menu-text">بخش مالی</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md  "></i>
                </li>
                @can('show_orders')
                    <x-admin.menu-item href="{{route('admin.order')}}" icon="flaticon2-box"  :active="request()->routeIs(['admin.order','admin.store.order','admin.create.order'])" label="سفارش ها" />
                @endcan
                @can('show_payments')
                    <x-admin.menu-item href="{{route('admin.payment')}}" icon="fab fa-cc-amazon-pay" :active="request()->routeIs(['admin.payment','admin.store.payment'])" label="پرداختی ها " />
                @endcan
                {{-- v3-teachers-checkouts --}}
                @can('show_checkouts')
                <x-admin.menu-item  href="{{route('admin.checkout')}}" icon="fmenu-icon fab fa-cc-amazon-pay" :active="request()->routeIs(['admin.checkout','admin.store.checkout'])" label="    تسویه حساب ها ({{$checkouts}})" />
                @endcan
                {{-- v3-teachers-bank-accounts --}}
                @can('show_bank_accounts')
                <x-admin.menu-item  href="{{route('admin.account')}}" icon="fa fa-piggy-bank" :active="request()->routeIs(['admin.account','admin.store.account'])" label="     حساب های بانکی ({{$bank_accounts}})" />
                @endcan
                {{-- v3-teachers-incoming-methods --}}
                @can('show_incoming_methods')
                <x-admin.menu-item  href="{{route('admin.incoming')}}" icon="fa fa-percent" :active="request()->routeIs(['admin.incoming','admin.store.incoming'])" label="روش های محاسبه درامد" />
                @endcan
                <li class="menu-section">
                    <h4 class="menu-text">بخش گزارشات</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_logs')
                    <x-admin.menu-item href="{{route('admin.log')}}" icon="flaticon2-list-1" :active="request()->routeIs(['admin.log'])" label=" لاگ های کاربر" />
                @endif
                @can('show_roll_calls')
                    <x-admin.menu-item href="{{route('admin.rollCall')}}" icon="flaticon2-list-1" :active="request()->routeIs(['admin.rollCall','admin.store.rollCall'])" label=" دفتر حضور غیاب" />
                @endif
                @role('administrator')
                <x-admin.menu-item href="{{route('log-viewer::dashboard')}}" icon="flaticon-book" :active="request()->routeIs(['telescope'])" label=" گزارش های سیستم logger" />
                <x-admin.menu-item href="{{route('telescope')}}" icon="flaticon-search" :active="request()->routeIs(['telescope'])" label=" گزارش های سیستم telescope" />
                @endif
                <li class="menu-section">
                    <h4 class="menu-text">بخش ارگان ها</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md "></i>
                </li>
                @can('show_organs')
                    <x-admin.menu-item href="{{route('admin.organ')}}" icon="fa fa-building" :active="request()->routeIs(['admin.organ','admin.store.organ'])" label=" ارگان ها ({{ $organs }})" />
                @endif
                <li class="menu-section">
                    <h4 class="menu-text">بخش کاربر</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_users')
                    <x-admin.menu-item href="{{route('admin.user')}}" icon="flaticon-users-1" :active="request()->routeIs(['admin.user','admin.store.user'])" label="کاربران ({{$users}})" />
                @endcan
                @can('show_roles')
                    <x-admin.menu-item href="{{route('admin.role')}}" icon="fas fa-key" :active="request()->routeIs(['admin.role','admin.store.role'])" label="نقش ها  " />
                @endcan
                <li class="menu-section">
                    <h4 class="menu-text">بخش فنی</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                @can('show_reductions')
                    <x-admin.menu-item href="{{route('admin.reduction')}}" icon="fas fa-percent" :active="request()->routeIs(['admin.reduction','admin.store.reduction'])" label="کد های تخفیف ها " />
                @endcan
                @can('show_forms')
                    <x-admin.menu-item href="{{route('admin.form')}}" icon="flaticon2-writing" :active="request()->routeIs(['admin.form','admin.store.form'])" label="فرم ها" />
                @endcan
                {{-- v2-storages --}}
                @can('show_storages')
                    <x-admin.menu-group icon="far fa-hdd" :active="request()->routeIs(
                    ['admin.storage','admin.store.storage','admin.acl','admin.store.acl'])" label="فضا های ذخیره سازی" >
                        <x-admin.menu-item href="{{route('admin.storage')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.storage','admin.store.storage'])" label="دیسک ها" />
                        <x-admin.menu-item href="{{route('admin.acl')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.acl','admin.store.acl'])" label="قوانین و دسترسی ها" />

                    </x-admin.menu-group>
                @endif
                @can('show_settings')
                    <x-admin.menu-group icon="flaticon2-settings" :active="request()->routeIs(
                    ['admin.setting.base','admin.setting.home','admin.setting.aboutUs','admin.setting.contactUs'
                       ,'admin.setting.fag','admin.setting.fag.create','admin.setting.sms','admin.setting.apply'])" label="تنظیمات" >
                        @can('show_settings_base')
                            <x-admin.menu-item href="{{route('admin.setting.base')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.base')" label="پایه " />
                        @endcan
                        @can('show_settings_home')
                            <x-admin.menu-item href="{{route('admin.setting.home')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.home')" label="صفحه اصلی " />
                        @endcan
                        @can('show_settings_sms')
                            <x-admin.menu-item href="{{route('admin.setting.sms')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.sms')" label="متن های ارسالی" />
                        @endcan
                        @can('show_settings_aboutUs')
                            <x-admin.menu-item href="{{route('admin.setting.aboutUs')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.aboutUs')" label="درباره ما " />
                        @endcan
                        @can('show_settings_contactUs')
                            <x-admin.menu-item href="{{route('admin.setting.contactUs')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.contactUs')" label="ارتباط با ما " />
                        @endcan
                        @can('show_settings_fag')
                            <x-admin.menu-item href="{{route('admin.setting.fag')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs(['admin.setting.fag','admin.setting.fag.create'])" label="سوالات متداول " />
                        @endcan
                            {{-- v3-apply-law --}}
                            @can('show_settings_contactUs')
                                <x-admin.menu-item href="{{route('admin.setting.apply')}}" icon="menu-bullet menu-bullet-dot" :active="request()->routeIs('admin.setting.apply')" label="مدرس شوید" />
                            @endcan
                    </x-admin.menu-group>
                @endcan
                <li class="menu-section">
                    <h4 class="menu-text"> خروج</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <x-admin.menu-item href="{{route('logout')}}" icon="flaticon-logout" :active="request()->routeIs('logout')" label="خروج" />
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>
<!--end::Aside-->
