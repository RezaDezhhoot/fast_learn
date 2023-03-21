<div wire:init="loadEpisode('','{{$episode_data['id']}}')">

    <livewire:site.episodes.header :course="$course_data" :episode="$episode_data"/>
    <section class="course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">
                    <div class="lecture-viewer-container">
                        <div class="lecture-video-item col-12  p-0">
                        @if(!is_null($episode_data->api_bucket))
                            {!! $episode_data->api_bucket !!}
                        @elseif(!empty($episode_data->local_video))
                                <div wire:loading.remove class="plyr plyr--full-ui plyr--video plyr--html5 plyr--fullscreen-enabled plyr--paused">
                                    <video  id="player" class="player" playsinline crossorigin controls data-poster="{{asset($course_data['image'])}}" poster="{{asset($course_data['image'])}}">
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- end lecture-viewer-container -->
                    <div class="lecture-video-detail">
                        <div class="lecture-tab-body bg-gray p-4">
                            <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                                <li class="nav-item mobile-menu-nav-item" >
                                    <a class="nav-link" id="course-content-tab" data-toggle="tab" href="#course-content" role="tab" aria-controls="course-content" aria-selected="false">
                                        محتوای دوره
                                    </a>
                                </li>
                                <li class="nav-item" >
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
                                        توضیحات
                                    </a>
                                </li>
                                @if($episode_data->can_homework)
                                    <li class="nav-item" >
                                        <a class="nav-link" id="homework-tab" data-toggle="tab" href="#homework" role="tab" aria-controls="homework" aria-selected="false">
                                            تمرین
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item" >
                                    <a class="nav-link" id="question-and-ans-tab" data-toggle="tab" href="#question-and-ans" role="tab" aria-controls="question-and-ans" aria-selected="false">
                                        تالار گفتوگو
                                    </a>
                                </li>
                                @if($course_data->teacher)
                                    <li class="nav-item" >
                                        <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">
                                            مربی
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="lecture-video-detail-body" >
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="course-content" role="tabpanel" aria-labelledby="course-content-tab">
                                    <div class="mobile-course-menu pt-4">
                                        <livewire:site.episodes.contents :course="$course_data" :chapter="$chapter_data" :episode="$episode_data" view="mobile" />
                                    </div>
                                </div>
                                <!-- end tab-pane -->
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="lecture-overview-wrap">
                                        {!! $episode_data['description'] !!}
                                    </div>
                                    <!-- end lecture-overview-wrap -->
                                </div>
                                <!-- end tab-pane -->
                                <div class="tab-pane fade" id="question-and-ans" role="tabpanel" aria-labelledby="question-and-ans-tab">
                                    <div class="lecture-overview-wrap lecture-quest-wrap">
                                        <livewire:site.episodes.comment :course="$course_data" :episode="$episode_data"/>
                                    </div>
                                </div>
                                <!-- end tab-pane -->
                                <div class="tab-pane fade" id="homework"  role="tabpanel" aria-labelledby="homework-tab">
                                    <div class="lecture-overview-wrap lecture-announcement-wrap">
                                        <livewire:site.episodes.homework :course="$course_data" :chapter="$chapter_data" :episode="$episode_data" :show_homework_form="$show_homework_form" />
                                    </div>
                                </div>
                                <!-- end tab-pane -->
                                @if($course_data->teacher)
                                    <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
                                    <div class="lecture-overview-wrap lecture-announcement-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="media media-card align-items-center">
                                                <a href="{{ route('teacher',$course_data->teacher->user->id) }}" class="media-img d-block rounded-full avatar-md">
                                                    <img src="{{ asset($course_data->teacher->user->image) }}" alt="آواتار مربی" class="rounded-full" />
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="pb-1"><a href="{{ route('teacher',$course_data->teacher->id) }}">{{$course_data->teacher->user->name }}</a></h5>
                                                </div>
                                            </div>
                                            <div class="lecture-owner-decription pt-4">
                                                {!! $course_data->teacher->body !!}
                                            </div>
                                            <!-- end lecture-announcement-comment-wrap -->
                                        </div>
                                        <!-- end lecture-overview-item -->
                                    </div>
                                </div>
                                @endif
                                <!-- end tab-pane -->
                            </div>
                            <!-- end tab-content -->
                        </div>
                        <!-- end lecture-video-detail-body -->
                    </div>
                    <livewire:site.includes.site.footer/>
                </div>
                <!-- end course-dashboard-column -->
                <div class="course-dashboard-sidebar-column" >
                    <button class="sidebar-open" type="button"><i class="la la-angle-right"></i> محتوای دوره</button>
                    <livewire:site.episodes.contents :course="$course_data" :chapter="$chapter_data" :episode="$episode_data" />
                    <!-- end course-dashboard-sidebar-wrap -->
                </div>
                <!-- end course-dashboard-sidebar-column -->
            </div>
            <!-- end course-dashboard-container -->
        </div>
        <!-- end course-dashboard-wrap -->
    </section>

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="برو بالا"></i>
    </div>

</div>
