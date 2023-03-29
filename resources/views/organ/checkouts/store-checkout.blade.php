<div>
    @section('title','درخواست تسویه حساب')
    <x-organ.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="درخواست تسویه حساب" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-organ.forms.input type="number" id="price" label="مبلغ(تومان) *" wire:model.defer="price" />
                <x-organ.forms.dropdown id="account" :data="$data['account']" label="حساب بانکی*" wire:model="account"/>
            </div>
        </div>
    </div>
</div>
