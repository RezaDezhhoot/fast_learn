<div wire:init="loadEpisode('','{{$episode_data['id']}}')">

    <livewire:site.episodes.header :course="$course_data" :episode="$episode_data"/>
    <section class="course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">
                    <div class="lecture-viewer-container">
                        <div class="lecture-video-item col-12 p-0" >
                        @if(!empty($episode_data->api_bucket))
                            {!! $episode_data->api_bucket !!}
                        @elseif($episode_data->local_video)
                                <div class="container-fluid" wire:ignore>
                                    <div wire:loading.remove class="plyr plyr--full-ui plyr--video plyr--html5 plyr--fullscreen-enabled plyr--paused">
                                        <video preload id="player" class="player"  controls data-poster="{{asset($course_data['image'])}}" poster="{{asset($course_data['image'])}}">
                                        </video>
                                    </div>
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
                <div class="course-dashboard-sidebar-column episode-list" >
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

    <div class="modal fade modal-container" id="quiz" tabindex="-1" role="dialog"  aria-hidden="true"  wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-beween border-bottom-gray">
                    <div class="d-flex align-items-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                            <span aria-hidden="true" class="la la-times"></span>
                        </button>
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">آزمون
                        </h5>
                    </div>

                    @if($quiz && $quizStarted)
                        <ul class="quiz-nav d-flex flex-wrap align-items-center">
                            <li>
                                <a ><i class="la la-clock mr-2"></i>زمان باقی مانده</a>
                            </li>
                            <li>
                                <div wire:ignore class="text-right  d-flex align-items-center justify-content-between">
                                    <h5 class="p-1" id="clock"></h5>
                                </div>
                            </li>
                        </ul>
                    @endif
                </div>
                <!-- end modal-header -->
                <div class="modal-body">
                    @if($quiz && $quizStarted)
                        <ul>
                            @foreach($questions as $key => $item)
                                <li>
                                    @if($key > 0)
                                        <hr>
                                    @endif
                                    <p>
                                        {!! $item['text'] !!}
                                    </p>
                                    <div class="col-12">
                                        <div class="">
                                            @foreach($item->choices as $choice)
                                                <div class="custom-control custom-checkbox mb-1 px-2 p-1">
                                                    <input  wire:model.defer="answers.{{$item->id}}" type="radio" id="{{ $choice->id }}" name="{{ $item->id }}" value="{{ $choice->id }}" class="custom-control-input" />
                                                    <label class="custom-control-label custom--control-label" for="{{ $choice->id }}">
                                                        {{ $choice->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>
                            @if($quiz?->type == \App\Enums\EpisodeQuizType::REQUIRED_TIME)
                                کاربر گرامی برای ادامه ویدیو می بایست در این آزمون نمره قبولی را کسب نمایید
                            @else
                                آیا تمایل به شرکت در آزمون این بخش دارید؟
                            @endif
                        </p>
                    @endif
                </div>
                <!-- end modal-body -->
                <div class="modal-footer justify-content-center border-top-gray">
                    <button wire:click="finishQuiz" class="btn btn-success {{ $quiz && $quizStarted ? "" : 'd-none' }}">پایان</button>
                    <button wire:click="startQuiz" class="btn btn-success {{ $quiz && $quizStarted ? "d-none" : '' }}">شروع آزمون</button>

                    @if($quiz?->type != \App\Enums\EpisodeQuizType::REQUIRED_TIME)
                        <button  data-dismiss="modal" class="btn btn-danger {{ $quiz && $quizStarted ? "d-none" : '' }}">خیر</button>
                    @endif
                </div>
                <!-- end modal-footer -->
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal-dialog -->
    </div>
    <div class="modal fade modal-container" id="result" tabindex="-1" role="dialog"  aria-hidden="true"  wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-beween border-bottom-gray">
                    <div class="d-flex align-items-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                            <span aria-hidden="true" class="la la-times"></span>
                        </button>
                        <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">نتیجه آزمون
                        </h5>
                    </div>
                </div>
                <!-- end modal-header -->
                <div class="modal-body">
                    <div class="row">
                        <div  style="overflow-x:auto;"  class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>عنوان ازمون</td>
                                    <td>{{ $result?->quiz?->title }}</td>
                                </tr>
                                <tr>
                                    <td>بارم </td>
                                    <td>{{   $result?->total_score }}</td>
                                </tr>
                                <tr>
                                    <td>نمره کسب شده </td>
                                    <td>{{   $result?->score }}</td>
                                </tr>
                                <tr>
                                    <td>وضعیت </td>
                                    <td>{{   $result?->passed ? 'قبول' : 'مردود' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end modal-body -->
                <div class="modal-footer justify-content-center border-top-gray">
                    <button  data-dismiss="modal" class="btn btn-danger">بستن</button>
                </div>
                <!-- end modal-footer -->
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal-dialog -->
    </div>

</div>

@push('scripts')
    <script>
        let requiredQuizAtTime = JSON.parse('@json($requiredQuizAtTime)');
        let optionalQuizAtTime = JSON.parse('@json($optionalQuizAtTime)');


        Livewire.on('updateRequiredQuiz', function (data) {
            requiredQuizAtTime = data;
        })
        Livewire.on('updateOptionalQuiz', function (data) {
            optionalQuizAtTime = data;
        })


        Livewire.on('setVideo', data => {
            const player = new Plyr('#player');
            window.player = player;
            player.source = {
                type: 'video',
                title: data.title,
                download: true,
                sources: [
                    {
                        src: data.src,
                        type: 'video/mp4',
                        size: 720,
                    }
                ]
            }
            player.on('ended', (event) => {
                @this.call('checkFinalQuiz')
            });

            player.on('timeupdate', (data) => {
                requiredQuizAtTime.forEach((item , Key) => {
                    if (Math.floor(player.currentTime) >= item.at && ! item.done) {
                        player.rewind(item.at);
                        player.pause();
                        @this.call('requiredQuiz' , {
                            id: item.id,
                            lastPoint: requiredQuizAtTime[Key - 1]?.at ?? 0
                        });
                        throw "exit"
                    }
                })
                optionalQuizAtTime.forEach((item) => {
                    console.log(player.currentTime)
                    if (Math.round(player.currentTime) === item.at && ! item.done) {
                        player.pause();
                        player.forward(0.51);
                        @this.call('requiredQuiz' , {
                            id: item.id
                        })
                    }
                })
            });

            Livewire.on('backToLastPoint', function (data) {
                player.rewind(data.at);
            })
        })


        Livewire.on('timer', function (data) {
            $('#clock').countdown(data.data)
                .on('update.countdown', function(event) {
                    var format = '%H:%M:%S';
                    if(event.offset.totalDays > 0) {
                        format = '%-d روز ' + format;
                    }
                    if(event.offset.weeks > 0) {
                        format = '%-w هفته ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function(event) {
                    $(this).html('اتمام زمان!')
                        .parent().addClass('disabled');
                    @this.call('finishQuiz')
                });
        })
    </script>
@endpush
