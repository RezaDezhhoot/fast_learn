@props(['categories','arrow' => false])
@foreach($categories as $item)
    <li>
        <a href="{{ route('courses',['category'=>$item['slug']]) }}">{{$item['title']}}
            @if(!empty($item['sub_categories']))
                @if($arrow)
                    <i class="la la-angle-left"></i>
                @endif
            @endif
        </a>
        @if(sizeof($item['sub_categories']) > 0)
            <ul class="sub-menu">
                @foreach($item['sub_categories'] as $key => $value)
                    <li><a href="{{route('courses',['category'=>$value])}}">{{$item['sub_categories_title'][$key]}}</a></li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach
