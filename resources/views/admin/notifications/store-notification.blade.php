<div>
    @section('title',' اعلان ')
    <x-admin.form-control mode="{{$mode}}" title="اعلان" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.dropdown with="6" id="subject" :data="$data['subject']" label="موضوع*" wire:model.defer="subject"/>
                <x-admin.forms.dropdown with="6" id="type" :data="$data['type']" label="نوع اعلان*" wire:model.defer="type"/>
            </div>

            <x-admin.forms.input type="text" id="user" label="شماره همراه کاربر*" wire:model.defer="user"/>
            <hr>
            <x-admin.forms.full-text-editor id="content" label="متن*" wire:model.defer="content"/>

        </div>
    </div>

</div>
