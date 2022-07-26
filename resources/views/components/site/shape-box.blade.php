@props(['item'])
<div class="col-lg-{{ $item['width'] ?? 4 }} responsive-column-half">
    <div class="card card-item hover-s text-center">
        <div class="card-body">
            <img src="{{asset($item['image'])}}" alt="{{$item['title']}}"class="img-fluid box-item-image rounded-full lazy">
            <h5 class="card-title pt-4 pb-2">{{$item['title']}}</h5>
            <p class="card-text text-justify">{{$item['description']}}</p>
            <div class="btn-box mt-20px">
                <a href="{{$item['link']}}" class="btn btn-outline-danger theme-btn-sm "><i class="la la-file-text-o mr-1"></i>مشاهده</a>
            </div>
        </div>
    </div>
</div>