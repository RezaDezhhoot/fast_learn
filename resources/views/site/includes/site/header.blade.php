<header class="header-menu-area custom-box-shadow">
    <div class="header-menu-content bg-white">
        <div class="container">
            <div class="main-menu-content p-0">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{route('home')}}" class="logo "><img class="logo-size" src="{{asset($logo)}}" alt="لوگو" /></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="جستجو کردن">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2" data-toggle="tooltip" data-placement="top" title="منوی دسته بندی">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="top" title="منوی اصلی">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <x-site.search-box/>
                            <div class="menu-category px-4">
                                <ul>
                                    <li>
                                        <a>دسته بندی ها <i class="la la-angle-down fs-12"></i></a>
                                        <ul class="cat-dropdown-menu">
                                            <x-site.header-categories arrow="true" :categories="$categories" />
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <nav class="main-menu">
                                <x-site.header-list />
                                <!-- end ul -->
                            </nav>
                            <!-- end main-menu -->
                            <div class="shop-cart pr-3 mr-3 border-left border-left-gray">
                                <ul>
                                    <li>
                                        <p class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-shopping-cart fs-22"></i>
                                            <span class="dot-status bg-1"></span>
                                        </p>
                                        <x-site.header-cart :cartContent="$cartContent" />
                                    </li>
                                </ul>
                            </div>
                            <div class="nav-left-button mr-3">
                                <ul class="generic-list-item">
                                    @auth()
                                        <div class="shop-cart user-profile-cart">
                                            <ul>
                                                <x-site.client.desktop-right-menu />
                                            </ul>
                                        </div>
                                    @else
                                        <li>
                                            <a href="{{ route('auth') }}" class="btn theme-btn theme-btn-sm text-white p-2"> ثبت نام/ورود</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- end menu-wrapper -->
                    </div>
                    <!-- end col-lg-10 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end header-menu-content -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="off-canvas-menu-close cat-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="right" title="بستن منو">
            <i class="la la-times"></i>
        </div>
        <!-- end off-canvas-menu-close -->
        <h4 class="off-canvas-menu-heading pt-20px">دسته بندی ها</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-5">
            <x-site.header-categories :categories="$categories" />
        </ul>
    </div>
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm" data-toggle="tooltip" data-placement="right" title="بستن منو">
            <i class="la la-times"></i>
        </div>
        <!-- end off-canvas-menu-close -->
        <x-site.header-list-responsive />
    </div>
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <x-site.search-box/>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div>
            <!-- end off-canvas-menu-close -->
        </div>
    </div>
    <!-- end off-canvas-menu -->
    <div class="body-overlay"></div>
</header>
