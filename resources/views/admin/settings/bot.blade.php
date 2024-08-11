<div>
    @section('title','تنظیمات ربات')
    <x-admin.form-control title="تنطیمات ربات"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">ربات</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input type="text" id="school_amount" label="مبلغ روزانه آموزشگاه*" wire:model.defer="school_amount"/>
            </div>
        </div>
    </div>
</div>
