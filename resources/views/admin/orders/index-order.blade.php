<div>
    @section('title',' سفارش ها ')
    <x-admin.form-control store="{{false}}" title="سفارش ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضیعت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>کد پیگیری سبد</th>
                            <th>جزئیات</th>
                            <th>وضعیت</th>
                            <th>مبلغ کل</th>
                            <th>خریدار</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $item)
                            <tr>
                                <td>{{ $item->tracking_code }}</td>
                                <td>
                                    @foreach($item->details as $order)
                                        <div class="border-bottom-info border">
                                            <span class="d-block text-info">
                                            دوره : {{ $order->product_data['title'] }}
                                            <br>
                                            کد پیگیری سفارش : {{ $order->tracking_code }}
                                        </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ number_format($item->price) }} تومان</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.order',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="7">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$orders->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
