<div>
    @section('title','تسویه حساب ها ')
    <x-admin.form-control :store="false" confirmContent="تعریف حساب جدید"  title=" تسویه حساب "/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره همراه</th>
                            <th>کد کاربر</th>
                            <th>نام</th>
                            <th>ادرس ایمیل</th>
                            <th>شماره درخواست</th>
                            <th>شماره کارت</th>
                            <th>شماره شبا</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>مبلغ (تومان)</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($checkouts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->bank_account_info['card_number'] }}</td>
                                <td>{{ $item->bank_account_info['sheba_number'] }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.checkout',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="14">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$checkouts->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>

