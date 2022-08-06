@props(['item'])
<div class="card card-item " {{ $attributes }}>
    <div class="card-image">
        <a href="{{ route('article',$item['slug']) }}" class="d-block">
            <img class="card-img-top" src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
        </a>
        <div class="course-badge-labels">
            <div class="course-badge">{{ $item->updated_date }}</div>
        </div>
    </div><!-- end card-image -->
    <div class="card-body">
        <h5 class="card-title"><a href="{{ route('article',$item['slug']) }}">{{ $item['title'] }}</a></h5>
        <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
            <li class="d-flex align-items-center">   توسط  {{ $item->user->name }} </li>
            <li class="d-flex align-items-center"><a >{{ $item->comments->count() }} نظر</a></li>
        </ul>
        <div class="d-flex justify-content-between align-items-center pt-3">
            <a href="{{ route('article',$item['slug']) }}" class="btn theme-btn theme-btn-sm theme-btn-white">ادامه مطلب <i class="la la-arrow-left icon ml-1"></i></a>
        </div>
    </div><!-- end card-body -->
</div>
