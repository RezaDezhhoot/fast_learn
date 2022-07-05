@props(['item'])
<div class="category-item">
    <img class="cat__img lazy" src="{{asset($item->image)}}" data-src="{{asset($item->image)}}" alt="{{$item->title}}">
    <div class="category-content">
        <div class="category-inner">
            <h3 class="cat__title"><a href="{{ !empty($item->data_type['route']) ?  route( $item->data_type['route'],['category'=>$item->slug]) : '#' }}">{{$item->title}}</a></h3>
            <p class="cat__meta">{{ $item->data_type['count'] }} {{ $item->data_type['label'] }}</p>
            <a href="{{ !empty($item->data_type['route']) ?  route( $item->data_type['route'],['category'=>$item->slug]) : '#' }}" class="btn theme-btn theme-btn-sm theme-btn-white">کاوش کنید<i class="la la-arrow-left icon ml-1"></i></a>
        </div>
    </div><!-- end category-content -->
</div>