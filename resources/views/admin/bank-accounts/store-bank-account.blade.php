<div>
    @section('title','حساب بانکی')
    <x-admin.form-control deleteAble="true" deleteContent="حذف حساب" mode="{{$mode}}" title="حساب بانکی" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>کد کاربری مدرس</th>
                            <th>نام مدرس</th>
                            <th>شماره همراه مدرس</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $account->user->id }}</td>
                            <td>{{ $account->user->name }}</td>
                            <td>{{ $account->user->phone }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>شماره کارت</th>
                            <th>شماره شبا</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $account->card_number }}</td>
                            <td>{{ $account->sheba_number }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model="status"/>
                @if($status == App\Enums\BankAccountEnum::SUSPENDED || $status == App\Enums\BankAccountEnum::REJECTED)
                    <x-admin.forms.text-area  label="علت"  wire:model.defer="result" id="result" />
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف !',
                text: 'آیا از حذف اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
