<div>
    @section('title','رسید  پرداخت ')
    <x-admin.form-control store="{{false}}" deleteAble="true" deleteContent="حذف رسید" mode="{{$mode}}" itle="رسید"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 invoice-header">
                    <h2>
                        <i class="fa fa-list-alt"></i>
                        {{ $payment->id }}
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-xs-12 col-sm-6 invoice-col">
                    <h3>مشخصات پرداخت :</h3>
                    <p>
                        <b> شماره شناسه :</b>
                        <span>
                        {{ $payment->id  }}
                    </span>
                    </p>
                    <p>
                        <b> کد پیگیری :</b>
                        <span>
                        {{ $payment->payment_ref  }}
                    </span>
                    </p>
                    <p>
                        <b> توکن درگاه :</b>
                        <span>
                        {{ $payment->payment_token   }}
                    </span>
                    </p>
                    <p>
                        <b>کد وضعیت :</b>
                        <span>
                        {{ $payment->status_code }}
                    </span>
                    </p>
                    <p>
                        <b> پیام :</b>
                        <span>
                        {{ $payment->status_message }}
                    </span>
                    </p>
                    <p>
                        <b> مبلغ(تومان) :</b>
                        <span>
                        {{ number_format($payment->amount) }}
                    </span>
                    </p>
                    <p>
                        <b> درگاه :</b>
                        <span>
                        {{ $payment->payment_gateway }}
                    </span>
                    </p>

                </div>
                <div class="col-xs-12 col-sm-6 invoice-col">
                    <h3>مشخصات کلی :</h3>
                    <p>
                        <b> نام کامل :</b>
                        <span>
                        <a title="مشاهده لاگ این کاربر" href="{{route('admin.log',['user'=>$payment->user->id])}}">{{ $payment->user->name }}</a>
                    </span>
                    </p>
                    <p>
                        <b> شماره هماره :</b>
                        <span>
                        {{ $payment->user->phone }}
                    </span>
                    </p>
                    <p>
                        <b> ایمیل :</b>
                        <span>
                        {{ $payment->user->email }}
                    </span>
                    </p>
                    <p>
                        <b> ای پی پرداخت کننده :</b>
                        <span>
                        {{ $payment->user->ip }}
                    </span>
                    </p>
                    <p>
                        <b> تاریخ :</b>
                        <span>
                        {{  $payment->date  }}
                    </span>
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <button class="btn btn-primary" onclick="window.print()">پرینت این صورت حساب</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem() {
            Swal.fire({
                title: 'حذف رسید!',
                text: 'آیا از حذف این رسید اطمینان دارید؟',
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
                            'رسید مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem')
                }
            })
        }
    </script>
@endpush
