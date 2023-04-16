<div wire:init="loadEpisode({{$episode_data['id']}})">
    <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
        <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
            <h3 class="fs-18 font-weight-semi-bold">محتوای دوره</h3>
            <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
        </div>
        <!-- end course-dashboard-side-heading -->
        <div class="course-dashboard-side-content">
            <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">
                @foreach($course_data->chapters as $key => $item)
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$item['id']}}" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="la la-angle-down"></i>
                                <i class="la la-angle-up"></i>
                                <span class="fs-15">بخش {{ $loop->iteration }}: {{ $item['title'] }} </span>
                                <span class="course-duration">
                                                        <span>{{$item['minutes']}} دقیقه</span>
                                                    </span>
                            </button>
                        </div>
                        <!-- end card-header -->
                        <div id="collapse{{$item['id']}}" class="collapse {{ $item['id'] == $chapter_data->id ? 'show' : '' }}" aria-labelledby="heading{{$item['id']}}" data-parent="#accordionCourseExample">
                            <div class="card-body p-0">
                                <ul class="curriculum-sidebar-list">
                                    @foreach($item->episodes as $value)
                                        <li class="course-item-link {{$value['id'] == $episode_data['id'] ? 'active': ''}}" >
                                            <div class="course-item-content-wrap">
                                                <!-- end custom-control -->
                                                @if($value['free'] || $course_data->price == 0 || (auth()->check() ) && (auth()->user()->hasCourse($course_data->id) || auth()->user()->hasRole('admin') )) )
                                                    <div class="course-item-content" wire:click="GoToEpisode({{$item['id']}},{{$value['id']}})">
                                                        <div>
                                                            <h4 class="fs-15">{{ $loop->iteration }}. {{ $value['title'] }}</h4>
                                                        </div>
                                                        <div class="courser-item-meta-wrap">
                                                            @if(!empty($value['time_label']))
                                                                <p class="course-item-meta"><i class="la la-clock-o"></i>{{ $value['time_label'] }}<p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="course-item-content">
                                                        <div>
                                                            <h4 class="fs-15">{{ $loop->iteration }}. {{ $value['title'] }}</h4>
                                                        </div>
                                                        <div class="courser-item-meta-wrap">
                                                            @if(!empty($value['time_label']))
                                                                <p class="course-item-meta"><i class="la la-clock-o"></i>{{ $value['time_label'] }}<p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endif
                                                @if($value['free'] || $course_data->price == 0 || (auth()->check() && (auth()->user()->hasCourse($course_data->id) || auth()->user()->hasRole('admin') ) ) )
                                                    @if(!empty($value['file']) || !empty($value['link']) || (!empty($value['local_video']) && $value['downloadable_local_video']) )
                                                        <div class="generic-action-wrap episode-refs">
                                                            <div class="dropdown">
                                                                <a
                                                                    class="btn theme-btn theme-btn-sm theme-btn-transparent mt-1 fs-14 font-weight-medium"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i class="la la-folder-open mr-1"></i> منابع<i class="la la-angle-down ml-1"></i>
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-left custom-pos">
                                                                    @if(!empty($value['local_video']) && $value['downloadable_local_video'])
                                                                        <a  wire:click="set_content('local_video','{{$value['id']}}')" class="dropdown-item" href="javascript:void(0)">
                                                                            دانلود ویدئو <i class="la la-video"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if(!empty($value['file']))
                                                                        <a  wire:click="set_content('file','{{$value['id']}}')" class="dropdown-item" href="javascript:void(0)">
                                                                            بارگیری <i class="la la-download"></i>
                                                                        </a>
                                                                    @endif
                                                                    @if(!empty($value['file']))
                                                                        <a  wire:click="set_content('link','{{$value['id']}}')" class="dropdown-item" href="javascript:void(0)">
                                                                            لینک <i class="la la-link"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="text-left">
                                                        <small class="text-danger">نقدی <i class="la la-lock">
                                                            </i></small>
                                                    </div>
                                                @endif

                                                <!-- end course-item-content -->
                                            </div>
                                            <!-- end course-item-content-wrap -->
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end collapse -->
                    </div>
                @endforeach
            </div>
            <!-- end accordion-->
        </div>
        <!-- end course-dashboard-side-content -->
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('setVideo', data => {
            const player = new Plyr('#player',{
                title: data.title,
            });
            player.source = {
                type: 'video',
                title: data.title,
                download: false,
                sources: [
                    {
                        src: data.src,
                        type: 'video/mp4',
                        size: 720,
                    }
                ]
            }
        })
    </script>
@endpush
