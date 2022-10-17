<div>
    @section('title','تنظیمات  مدرس شوید')
    <x-admin.form-control  title="تنظیمات "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.forms.full-text-editor id="apply_law" label="توضیخات و قوانین" wire:model.defer="apply_law"/>
        </div>
    </div>
</div>
