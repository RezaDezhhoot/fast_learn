@props(['cartContent'])
@if(sizeof($cartContent) > 0)
    <ul class="cart-dropdown-menu after-none">
        @foreach($cartContent as $item)
            <li class="media media-card">
                <a class="media-img">
                    <img class="mr-3" src="{{asset($item->image)}}" alt="تصویر سبد خرید" />
                </a>
                <div class="media-body">
                    <h5>{{$item->title}}</h5>
                    <p class="text-black font-weight-semi-bold lh-18">{{number_format($item->total())}} تومان </p>
                </div>
            </li>
        @endforeach
        <li class="media media-card">
            <div class="media-body fs-16">
                <p class="text-black font-weight-semi-bold lh-18"> مجموع: {{number_format(App\Http\Controllers\Cart\Facades\Cart::price()-App\Http\Controllers\Cart\Facades\Cart::discount())}}</p>
            </div>
        </li>
        <li>
            <a href="{{route('cart')}}" class="btn theme-btn w-100">ادامه فرایند خرید <i class="la la-arrow-left icon ml-1"></i></a>
        </li>
    </ul>
@endif
