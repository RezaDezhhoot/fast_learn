<div>
    @section('title',' سفارش  ')
    <x-admin.form-control  deleteAble="true" deleteContent="حذف سفارش" mode="{{$mode}}" title="سفارش"/>
    <div class="card card-custom gutter-b example example-compact">
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.form-section label="کاربر">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>کد کاربر</th>
                                <td>نام</td>
                                <td>شماره همراه</td>
                                <td>وضعیت</td>
                                <td>ای پی کاربر</td>
                                <th>مشاهده لاگ ها</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $order->user->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->phone }}</td>
                                <td>{{ $order->user->status_label }}</td>
                                <td>{{ $order->user->ip }}</td>
                                <td>
                                    <a title="مشاهده لاگ این کاربر" href="{{route('admin.log',['user'=>$order->user->id])}}">مشاهده</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section label="سبد سفارش">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>کد پیگیری سبد:</th>
                                <th>شماره شناسه پرداخت:</th>
                                <th>درگاه پرداخت:</th>
                                <th>کد پیگیری درگاه:</th>
                                <th>ای پی پرداخت کننده</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$order->tracking_code}}</td>
                                <td>{{$order->payment->id ?? ''}}</td>
                                <td>{{$order->payment->payment_gateway ?? ''}}</td>
                                <td>{{$order->payment->payment_ref ?? ''}}</td>
                                <td>{{$order->payment->ip ?? ''}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>

                                <td>هزینه کل:</td>
                                <td>کیف پول :</td>
                                <td> هزینه مدرسین:</td>
                                <td>هزینه پرداخت شده:</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{number_format($order->price)}}تومان </td>
                                <td>{{number_format($order->wallet_pay)}}تومان </td>
                                <td>{{number_format($order->details->sum('teacher_amount'))}}تومان </td>
                                <td>{{number_format($order->total_price)}} تومان </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>کد تخفیف:</td>
                                <td>بابت کد تخفیف:</td>
                                <td>تخفیف محصولات:</td>
                                <td>تخفیف کل:</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $order->reduction_code }}</td>
                                <td>{{ number_format($order->reductions_value - $order->discount) }} تومان </td>
                                <td>{{ number_format($order->discount) }} تومان </td>
                                <td>{{ number_format($order->reductions_value) }} تومان </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section label="یادداشت های این سفارش">
                <div class="row">
                    <table class="table  table-bordered">
                        <thead>
                        <tr>
                            <td>یادداشت</td>
                            <td>تاریخ</td>
                            <td>کاربر</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($order->notes) > 0)
                            @foreach($order->notes as $note)
                                <tr>
                                    <td>{{ $note->note }}</td>
                                    <td>{{ $note->date }}</td>
                                    <td>{{ $note->user->name ?? 'سیستم' }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </x-admin.form-section>
            <x-admin.form-section label="جزییات سفارش">
                <div class="row">
                    @foreach($details as $key => $detail)
                        <div class="col-12 mt-3 p-4" style="border: 1px solid #eaeaea;border-radius: 10px;">
                            <h3> کد پیگیری سفارش: {{$detail->tracking_code}}</h3>
                            <table class="table  table-bordered">
                                <thead>
                                <tr>
                                    <td>نام دوره:</td>
                                    <td>هزینه کل:</td>
                                    <td>تخفیف:</td>
                                    <td>کیف پول:</td>
                                    <td> هزینه مدرس:</td>
                                    <td>هزینه پرداخت شده:</td>
                                    <td>وضعیت:</td>
                                    <td>عملیات:</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $detail->product_data['title'] }}</td>
                                    <td>{{ number_format($detail->price) }}تومان  </td>
                                    <td>{{ number_format($detail->reduction_amount) }}تومان  </td>
                                    <td>{{ number_format($detail->wallet_amount) }}تومان  </td>
                                    <td>{{ number_format($detail->teacher_amount) }}تومان  </td>
                                    <td>{{ number_format($detail->total_price) }}تومان  </td>
                                    <td>
                                        <div class="form-group">
                                            <x-admin.forms.dropdown id="status{{$detail->id}}" :data="$data['status']" label="وضعیت*" wire:model.defer="statuses.{{$detail->id}}"/>
                                        </div>
                                    </td>
                                    <td>
                                        <x-admin.delete-btn onclick="deleteDetail({{$key}})" />
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @if(!empty($detail->refund) && !is_null($detail->refund))
                                <div class="col-12">
                                    <x-admin.form-section label="مرجوعیت این سفارش">
                                        <table class="table  table-bordered">
                                            <thead>
                                            <tr>
                                                <td>تعداد</td>
                                                <td>وضعیت</td>
                                                <td>وضعیت</td>
                                                <td>تاریخ</td>
                                                <td>مشاهده</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{ $detail->refund->quantity }}</td>
                                                <td>{{ $detail->refund->status_label }}</td>
                                                <td>{{ $detail->refund->date }}</td>
                                                <td>
                                                    <x-admin.edit-btn href="{{ route('admin.store.refund',['edit', $detail->refund->id]) }}" />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </x-admin.form-section>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>

        </div>
    </div>
</div>
@push('scripts')
    <script>

        function deleteDetail(id) {
            Swal.fire({
                title: 'حذف سفارش!',
                text: 'آیا از حذف این سفارش اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'سفارش مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteDetail', id)
                }
            })
        }

        function deleteItem(id) {
            Swal.fire({
                title: 'حذف سفارش!',
                text: 'آیا از حذف این سفارش اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
