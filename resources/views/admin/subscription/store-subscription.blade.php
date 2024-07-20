<div>
    @section('title',' اشتراک ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف اشتراک" mode="{{$mode}}" title="اشتراک" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>

                <x-admin.forms.input with="6" type="number" id="amount" label="مبلغ قابل پرداخت*" wire:model.defer="amount"/>
                <x-admin.forms.input with="6" type="number" id="value" label="مقدار پول*" wire:model.defer="value"/>

                <x-admin.forms.lfm-standalone id="image" label="تصویر" :file="$image" type="image" required="true" wire:model="image"/>
                <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
            </div>
        </div>
    </div>
</div>
