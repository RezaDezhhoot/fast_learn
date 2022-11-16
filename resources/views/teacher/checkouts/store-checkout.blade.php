<div>
    @section('title','درخواست تسویه حساب')
    <x-teacher.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="درخواست تسویه حساب" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-teacher.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-teacher.forms.input type="number" id="price" label="مبلغ(تومان) *" wire:model.defer="price" />
                <x-teacher.forms.dropdown id="account" :data="$data['account']" label="حساب بانکی*" wire:model="account"/>
            </div>
        </div>
    </div>
</div>
