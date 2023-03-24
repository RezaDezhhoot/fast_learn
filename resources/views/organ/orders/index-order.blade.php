<div>
    @section('title',' سفارش ها ')
    <x-organ.form-control store="{{false}}" title="سفارش ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-organ.forms.dropdown id="status" :data="$data['status']" label="وضیعت" wire:model="status"/>
            @include('organ.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد پیگیری سبد</th>
                            <th>خریدار</th>
                            <th>دوره اموزشی</th>
                            <th>مبلغ کل</th>
                            <th>مبلغ مدرس</th>
                            <th>مبلغ اموزشگاه</th>
                            <th>مبلغ کیف پول</th>
                            <th>مبلغ تخفیف</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tracking_code }}</td>
                                <td>
                                    <ul>
                                        <li>{{ $item->order->user->name ?? '' }}</li>
                                        <li>{{ $item->order->user->phone ?? '' }}</li>
                                        <li>{{ $item->order->user->email ?? '' }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->product_data['title'] }}</td>
                                <td>{{ number_format($item->total_price) }} تومان</td>
                                <td>{{ number_format($item->teacher_amount) }} تومان</td>
                                <td>{{ number_format($item->organ_amount) }} تومان</td>
                                <td>{{ number_format($item->wallet_amount) }} تومان</td>
                                <td>{{ number_format($item->reduction_amount) }} تومان</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->date }}</td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="13">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$orders->links('organ.layouts.paginate')}}
        </div>
    </div>
</div>
