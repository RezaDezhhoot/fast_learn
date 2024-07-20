<div>
    <x-site.breadcrumbs :data="$page_address" title="جزئیات خرید خدرید اشتراک" />
    <section class="cart-area">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered generic-table">
                    <thead>
                    <tr>
                        <th>عنوان اشتراک</th>
                        <th>قیمت اشتراک</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!is_null($subscription))
                        <tr>
                            <td>
                                {{ $subscription->title }}
                            </td>
                            <td>
                                {{ number_format($subscription->amount) }} تومان
                            </td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td  class="text-center" colspan="4">{{ $message }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- end container -->
    </section>
</div>
