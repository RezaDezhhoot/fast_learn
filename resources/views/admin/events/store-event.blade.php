<div>
    @section('title','رویداد جدید')
    <x-admin.form-control  mode="{{$mode}}" title="رویداد" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.dropdown with="6" id="event" :data="$data['event']" label="عملیات رویداد*" wire:model.defer="event"/>
                <x-admin.forms.dropdown with="6" id="count" :data="$data['count']" label="تعداد *" wire:model.defer="count"/>
                <x-admin.forms.dropdown with="6" id="orderBy" :data="$data['orderBy']" label="مرتب سازی کاربران بر اساس*" wire:model.defer="orderBy"/>
            </div>
            <hr>
            <x-admin.forms.text-area label="متن اصلی*" wire:model.defer="body" id="body" />
        </div>
    </div>
</div>
