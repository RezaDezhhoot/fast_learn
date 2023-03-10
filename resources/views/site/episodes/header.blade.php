<div>
    <section class="header-menu-area">
        <div class="header-menu-content bg-dark">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="course-dashboard-header-title pl-4">
                        <a class="text-white fs-15">{{ $episode_data->title }}</a>
                    </div>
                    <div class="menu-wrapper ml-auto">
                        <div class="nav-left-button d-flex align-items-center">
                            <a wire:click="like" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 text-white mr-2" >
                                <i class="la {{ $has_liked ? 'la-star' : 'la-star-o' }} mr-1"></i> امتیاز دهید
                            </a>
                            <a href="{{route('course',$course_data->slug)}}" class="btn theme-btn theme-btn-sm theme-btn-transparent lh-26 d-flex align-items-center text-white mr-2">  بازگشت به دوره اموزشی<i class="la la-arrow-left mr-1 la-lg"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
