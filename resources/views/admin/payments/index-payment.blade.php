<div>
    @section('title','رسید های پرداخت ')
    <x-admin.form-control store="{{false}}" title="رسید های پرداخت"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.input type="text" id="user" label="نام کاربری یا شماره همراه کاربر" wire:model="user" />
            <x-admin.forms.input type="text" id="ip" label="ای پی پرداخت کننده" wire:model="ip" />
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>پرداخت کننده</th>
                            <th>ای پی</th>
                            <th>وضعیت</th>
                            <th>نتیجه</th>
                            <th>مبلع(تومان)</th>
                            <th>درگاه</th>
                            <th>کد پیگیری</th>
                            <th>پیام</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td><a title="مشاده لاگ های این کاربر" href="{{route('admin.log',['user'=>$item->user->id])}}">{{ $item->user->name }}</a></td>
                                <td>{{ $item->user->ip }}</td>
                                <td>{{ $item->status_code }}</td>
                                <td>{{ $item->payment_ref ? 'تایید شده' : 'تایید نشده' }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>{{ $item->payment_gateway }}</td>
                                <td>{{ $item->payment_ref }}</td>
                                <td>{{ $item->status_message }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.payment',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="12">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$payments->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
