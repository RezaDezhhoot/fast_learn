@props(['item','show_details'=>true])
<div {{ $attributes }}>
    <div class="card card-item card-preview" data-tooltip-content="#{{$item['slug'].$item['id']}}">
        <div class="card-image">
            <a href="{{ route('course',$item['slug']) }}" class="d-block">
                <img class="card-img-top" src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" />
            </a>
            <div class="course-badge-labels">
                <div class="course-badge">{{ $item['status_label'] }}</div>
                @if($item['has_reduction'] && $item['base_price'] > 0)
                    <div class="course-badge blue">٪{{ $item['reduction_percent'] }}-</div>
                @endif
                <div class="course-badge green">{{ $item['type_label'] }}</div>
            </div>
        </div>
        <!-- end card-image -->
        <div class="card-body">
            @if(isset($item['category']))
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                    <a href="{{ route('courses',['category'=>$item['category']['slug']]) }}">{{ $item['category']['title'] }}</a>
                </h6>
            @endif
            <h5 class="card-title"><a href="{{ route('course',$item['slug']) }}">{{ $item['title'] }}</a></h5>
            @if(!is_null($item['teacher']))
            <p class="card-text"><a href="{{ route('teacher',$item['teacher']['id']) }}">{{ $item['teacher']->user->name ?? '' }}</a></p>
            @endif
{{--            <div class="rating-wrap d-flex align-items-center py-2">--}}
{{--                <div class="review-stars">--}}
{{--                    <span class="rating-number">{{ $item['score'] }}</span>--}}
{{--                    @for($i=1; $i<=5;$i++) @if($i <=$item['score'])--}}
{{--                        <span class="la la-star"></span>--}}
{{--                        @else--}}
{{--                        <span class="la la-star-o"></span>--}}
{{--                        @endif--}}
{{--                    @endfor--}}
{{--                </div>--}}
{{--                <span class="rating-total pl-1">({{$item['sold_count']}})</span>--}}
{{--            </div>--}}
{{--            <!-- end rating-wrap -->--}}
            <div class="d-flex justify-content-between align-items-center">
                @if($item['has_reduction'] && $item['base_price'] > 0)
                <p class="card-price text-black font-weight-bold">{{ number_format($item['price']) }} تومان
                    <span class="before-price font-weight-medium">{{ number_format($item['base_price']) }} تومان</span>
                </p>
                @elseif($item['base_price'] == 0 || $item['price'] == 0)
                <p class="card-price text-black font-weight-bold">
                    رایگان
                </p>
                @else
                <p class="card-price text-black font-weight-bold">
                    {{ number_format($item['price']) }} تومان
                </p>
                @endif
            </div>
        </div>
        <!-- end card-body -->
        @if($show_details)
            <div class="tooltip_templates">
            <div id="{{$item['slug'].$item['id']}}" wire:ignore>
                <div class="card card-item">
                    <div class="card-body">
                        <h5 class="card-title pb-1"><a href="{{ route('course',$item['slug']) }}">{{ $item['title'] }}</a></h5>
                        <hr>
                        <div class="d-flex align-items-center pb-1">
                            <h6 class="ribbon fs-14 mr-2">{{ $item['status_label'] }}</h6>
                        </div>
                        <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                            <li>{{ $item['hours'] }} ساعت در کل</li>
                        </ul>
                        <p class="card-text pt-1 fs-14 lh-22">
                            {!! $item['short_body'] !!}
                        </p>
                    </div>
                </div><!-- end card -->
            </div>
        </div>
        @endif
    </div>


</div>
