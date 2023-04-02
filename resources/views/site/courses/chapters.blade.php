<div class="curriculum-content">

    <div id="accordion" class="generic-accordion" wire:ignore.self>

        <p class="alert alert-info w-100" wire:loading wire:target="loadCourse">
            در حال بارگزاری ...
        </p>

        @if(sizeof($chapters) > 0)
            @foreach($chapters as $key => $item)
                <div class="card" wire:ignore>
                    <div class="card-header">
                        <button
                            class="btn btn-link d-flex align-items-center justify-content-between"
                            data-toggle="collapse" data-target="#collapse{{$item['id']}}"
                            aria-expanded="{{  $key == 0 ? 'true' : 'false' }}"
                            aria-controls="collapse{{$item['id']}}">
                            <i class="la la-plus"></i>
                            <i class="la la-minus"></i>
                            <p>
                                <small class="episode_counter">{{ $loop->iteration }}</small>
                                {{ $item['title'] }}
                            </p>

                            <span class="fs-15 text-gray font-weight-medium">{{ $item['episode_count'] }} درس</span>

                        </button>
                    </div>
                    <!-- end card-header -->


                    <div id="collapse{{$item['id']}}" class="collapse {{  $key == 0 ? 'show' : '' }}"
                         aria-labelledby="heading{{$item['id']}}" data-parent="#accordion">
                                <div class="card-body pt-2">
                                    @if(!empty($item['description']))
                                        <p class="px-0 text-black">
                                            <i class="la la-star mr-1"></i>
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                    <hr>
                                    <ul class="generic-list-item">
                                        @foreach($item['episode_title_list'] as $episode)
                                            <li>
                                                    <a href="{{route('episode',[$course['slug'],$item['slug'],$episode['id'],$episode['title']])}}" class="d-flex align-items-center justify-content-between">
                                                                <div class="episode-title">
                                                                    <i class="la la-video mr-1"></i>
                                                                    {{$episode['title']}}
                                                                </div>
                                                    <span>
                                                        {{ $episode['time'] }}
                                                    </span>
                                                    @if($episode['free'] || $course->price == 0)
                                                        <small class="text-success">رایگان <i class="la la-lock-open">
                                                            </i></small>
                                                    @elseif(auth()->check() && $user->hasCourse($course->id))
                                                        <small class="text-success">خریداری شده <i class="la la-lock-open">
                                                            </i></small>
                                                    @elseif(!auth()->check() || (auth()->check() &&
                                                    !$user->hasCourse($course->id)))
                                                        <div class="text-left">
                                                            <small class="text-danger">نقدی <i class="la la-lock">
                                                                </i></small>
                                                        </div>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                    </div>
                    <!-- end collapse -->
                </div>
            @endforeach
        @else
            <p class="alert alert-info" wire:loading.remove >
                هنوز هیچ درسی منتشر نشده است.
            </p>
        @endif
    </div>
    <!-- end generic-accordion -->
</div>
