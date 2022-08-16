<div>
    <x-site.breadcrumbs :data="$page_address" title="جزئیات خرید" />
    <section class="cart-area">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered generic-table">
                    <thead>
                    <tr>
                        <th>نام دوره</th>
                        <th>قیمت دوره</th>
                        <th>قیمت کل </th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!is_null($order))
                        @foreach($order->details as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('course',$item->course->slug) }}">{{ $item->course->title }}</a>
                                </td>
                                <td>
                                    {{ number_format($item->price) }} تومان
                                </td>
                                <td>{{ number_format($item->total_price) }}تومان</td>
                                <td>{{ $item->status_label }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                       <tr>
                           <td  class="text-center" colspan="4">{{ $message }}</td>
                       </tr>
                    </tfoot>
                </table>
               <div class="mt-4">
                   @if($isSuccessful)
                       <p class="text-center"><a class="btn btn-outline-primary mb-3" href="{{ route('user.courses') }}">مشاهده دوره ها</a></p>
                   @else
                       <div class="text-center">
                           <button class="btn btn-outline-warning mb-3" wire:click="try_again">پرداخت مجدد</button>
                           <br>
                           <div class="text-right" wire:loading>
                               <p class="text-secondary text-right">
                                   در حال پردازش ...
                               </p>
                           </div>
                       </div>
                   @endif
               </div>
            </div>
        </div>
        <!-- end container -->
    </section>
</div>
