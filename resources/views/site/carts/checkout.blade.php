<div>
    <x-site.breadcrumbs :data="$page_address" title="تکمیل پرداخت"/>
    <section class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">خلاصه سفارش</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">قیمت اصلی: </span>
                                    <span>{{number_format(App\Http\Controllers\Cart\Facades\Cart::total())}}  تومان</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">کد تخفیف : </span>
                                    <span>{{ number_format($voucherAmount) }} تومان</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">کیف پول : </span>
                                    <span>{{ number_format($walletAmount) }} تومان</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">مجموع: </span>
                                    <span>{{number_format(App\Http\Controllers\Cart\Facades\Cart::total($walletAmount,$voucherAmount,0))}} تومان</span>
                                </li>
                            </ul>
                            <div class="btn-box border-top border-top-gray pt-3">
                                <div class="form-group text-right">
                                    <label>
                                        <input wire:model="useWallet" name="check_method" type="checkbox">    استفاده از کیف پول
                                    </label>
                                    @error('payment')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                            <div class="btn-box border-top border-top-gray pt-3">
                                <div class="card-body">
                                    <h3 class="card-title fs-22 pb-3">روش پرداخت را انتخاب کنید</h3>
                                    <div class="divider"><span></span></div>
                                    <div class="payment-option-wrap">
                                        <div class="row">
                                            @foreach($gateways as $key => $item)
                                                <div class="col-12 col-md-4">
                                                    <div class="p-2">
                                                        <img  src="{{ asset($item['logo']) }}" alt="">
                                                        <input id="{{$key}}" name="gateway" type="radio" wire:model.defer="gateway" value="{{$key}}" />
                                                        <label for="{{$key}}">
                                                            {{$item['title']}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('gateway')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">جزئیات سفارش</h3>
                            <div class="divider"><span></span></div>
                            <div class="order-details-lists">
                                @foreach($cartContent as $item)
                                    <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                    <a class="media-img">
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" />
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15 pb-2"> <a class="text-black font-weight-semi-bold">{{ $item->title }}</a></h5>
                                        <p class="text-black font-weight-semi-bold lh-18">{{ number_format($item->price) }} تومان</p>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end media -->
                            </div>
                            <!-- end order-details-lists -->
                            <div class="d-flex flex-wrap align-items-center justify-content-between pt-4">
                                <form wire:submit.prevent="checkVoucherCode">
                                    <div class="input-group mb-2">
                                        <input wire:model.defer="voucherCode" class="form-control form--control pl-3" type="text" name="search" placeholder="کد تخفیف" />
                                        <div class="input-group-append">
                                            <button type="submit" class="btn theme-btn">کد را اعمال کنید</button>
                                        </div>
                                    </div>
                                    @error('voucher')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </form>
                            </div>
                            <div class="pt-4">
                                <button wire:click="payment" class="btn theme-btn w-100">ادامه دهید <i class="la la-arrow-left icon ml-1"></i></button>
                                <p wire:loading class="text-secondary text-right">
                                    در حال پردازش ...
                                </p>
                            </div>
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

</div>
