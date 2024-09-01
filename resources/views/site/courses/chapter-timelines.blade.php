<div class="row">
    <div class="col-12">
        @if(sizeof($chapters) > 0)
            <ol class="timeline">
                @foreach($chapters as $key => $item)
                    <li>
                        @if(sizeof($item['episode_title_list']) > 0)
                            @foreach($item['episode_title_list'] as $episode)
                                <p class="event-date">
                                    @if(($episode['free'] || $course->price == 0 || $hasCourse ) ||
(auth()->check() && (  \App\Models\UserTicket::where('user_id',auth()->id())->whereNull('used_by')->count() >= 2 || \App\Models\UserTicket::where('user_id',auth()->id())->where('used_by',$episode['id'])->exists() )))
                                        <a href="{{route('episode',[$course['slug'],$item['slug'],$episode['id'],$episode['title']])}}" class="d-flex text-white align-items-center justify-content-between">
                                            {{ $item['title'] }} (<span class="fs-15  text-white font-weight-medium">{{ $item['episode_count'] }} درس</span>)
                                        </a>
                                    @else
                                        <a class="text-decoration-none text-white" href="">
                                            {{ $item['title'] }}
                                            <br>
                                            (<span class="fs-15 text-white font-weight-medium">{{ $item['episode_count'] }} درس</span>)
                                        </a>

                                    @endif
                                </p>
                                @break
                            @endforeach
                        @else
                            <p class="event-date">
                                <a  class="text-white">{{ $item['title'] }} (<span class="fs-15 text-white font-weight-medium">{{ $item['episode_count'] }} درس</span>)</a>

                            </p>
                        @endif

                        <p class="event-description text-white">
                            {{ $item['description'] }}
                        </p>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
</div>
