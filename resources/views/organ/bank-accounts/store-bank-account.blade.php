<div>
    @section('title','حساب بانکی')
    <x-organ.form-control deleteAble="{{false}}"  mode="{{$mode}}" title="حساب بانکی" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-organ.forms.input  type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-organ.forms.input placeholder=" 0000-0000-0000-0000" class="text-right" dir="ltr" type="text" id="card_number" label="شماره کارت *" wire:model.defer="card_number" />
                <x-organ.forms.input placeholder="IR00-0000-0000-0000-0000-0000-00" help="با IR شروع شود" class="text-right" dir="ltr" type="text" id="sheba_number" label="شماره شبا *" wire:model.defer="sheba_number" />
            </div>
        </div>
    </div>
</div>
