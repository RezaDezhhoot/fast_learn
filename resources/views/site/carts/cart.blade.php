<div>
    <x-site.breadcrumbs :data="$page_address" title="سبد خرید" />
    <section class="cart-area">
        <div class="container">
            <div class="table-responsive">
                @if (sizeof($cartContent) > 0)
                <table class="table generic-table">
                    <thead>
                        <tr>
                            <th scope="col">تصویر</th>
                            <th scope="col">مشخصات محصول</th>
                            <th scope="col">قیمت دوره</th>
                            <th scope="col">قیمت کل</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($cartContent as $item)
                        <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a class="media-img mr-0">
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a class="text-black font-weight-semi-bold">{{ $item->title }}</a>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">{{ number_format($item->basePrice) }} تومان</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">{{ number_format($item->total()) }} تومان</li>
                                </ul>
                            </td>
                            <td>
                                <button wire:click="deleteItem({{$item->id}})" type="button"
                                    class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip"
                                    data-placement="top" title="برداشتن">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
                @else
                <div class="text-center pb-4">
                    <img class="mx-auto no-date d-block" src="{{ asset('site/svg/No-data-cuate.svg') }}" alt="">
                    <h5 class="mt-3">سبد خرید شما خالی می باشد!</h5>
                </div>
                @endif
            </div>
            @if (sizeof($cartContent) > 0)
            <div class="col-lg-4 ml-auto">
                <div class="bg-gray p-4 rounded-rounded mt-40px">
                    <h3 class="fs-18 font-weight-bold pb-3">مجموع سبد خرید</h3>
                    <div class="divider"><span></span></div>
                    <ul class="generic-list-item pb-4">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">جمع فرعی: </span>
                            <span>{{number_format(App\Http\Controllers\Cart\Facades\Cart::price())}} تومان </span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">مجموع: </span>
                            <span>{{number_format(App\Http\Controllers\Cart\Facades\Cart::price() -
                                App\Http\Controllers\Cart\Facades\Cart::discount())}} تومان </span>
                        </li>
                    </ul>
                    <a href="{{ route('checkout') }}" class="btn theme-btn w-100">پرداخت <i
                            class="la la-arrow-left icon ml-1"></i></a>
                </div>
            </div>
            @endif
        </div>
        <!-- end container -->
    </section>
</div>