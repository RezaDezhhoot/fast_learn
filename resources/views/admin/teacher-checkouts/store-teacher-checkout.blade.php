<div>
    @section('title','درخواست تسویه حساب')
    <x-admin.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="درخواست تسویه حساب" />

    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row pb-4">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>کد مدرس</th>
                            <td>نام</td>
                            <td>شماره همراه</td>
                            <td>وضعیت</td>
                            <td>ای پی مدرس</td>
                            <th>مشاهده لاگ ها</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $checkout->user->id }}</td>
                            <td>{{ $checkout->user->name }}</td>
                            <td>{{ $checkout->user->phone }}</td>
                            <td>{{ $checkout->user->status_label }}</td>
                            <td>{{ $checkout->user->ip }}</td>
                            <td>
                                <a title="مشاهده لاگ این کاربر" href="{{route('admin.log',['user'=>$checkout->user->id])}}">مشاهده</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>شماره کارت</th>
                            <th>شماره شبا</th>
                            <th>مبلغ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $checkout->bank_account_info['card_number'] }}</td>
                            <td>{{ $checkout->bank_account_info['sheba_number'] }}</td>
                            <td>{{ number_format($checkout->price) }} تومان </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model="status"/>
                <x-admin.forms.full-text-editor id="result" label="نتیجه درخواست" wire:model.defer="result"/>
            </div>
        </div>

    </div>
</div>
