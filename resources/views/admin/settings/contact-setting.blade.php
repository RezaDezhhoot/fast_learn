<div>
    @section('title','تنظیمات ارتباط با ما')
    <x-admin.form-control  title="تنظیمات "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input type="text" id="tel" label="تلفن*" wire:model.defer="tel"/>
                <x-admin.forms.input type="email" id="email" label="ایمیل*" wire:model.defer="email"/>
                <x-admin.forms.input type="text" id="address" label="ادرس*" wire:model.defer="address"/>
                <x-admin.forms.input type="text" id="googleMap" label="شناسه گوگل مپ" wire:model.defer="googleMap"/>
                <x-admin.forms.full-text-editor type="text" id="contactText" label="متن" wire:model.defer="contactText"/>
            </div>
            <x-admin.form-section label="لینک های ارتباطی">
                <div class="row">
                    <x-admin.forms.input with="3" type="text" id="instagram" placeholder="instagram" label="اینستاگرام" wire:model.defer="instagram"/>
                    <x-admin.forms.input with="3" type="text" id="twitter" placeholder="twiter" label="توییتر" wire:model.defer="twitter"/>
                    <x-admin.forms.input with="3" type="text" id="youtube" placeholder="youtube" label="یوتیوب" wire:model.defer="youtube"/>
                    <x-admin.forms.input with="3" type="text" id="telegram" placeholder="telegram" label="تلگرام" wire:model.defer="telegram"/>
                </div>
            </x-admin.form-section>
            <x-admin.form-section label="موضوعات تیکت">
                <div class="border p-3">
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن موضوع" wire:click="addSubject()" />
                    @foreach($subject as $key => $item)
                        <div class="form-group d-flex align-items-center col-12">
                            <input class="form-control col-11" id="{{ $key }}subject" type="text" placeholder="عنوان" wire:model.defer="subject.{{$key}}">
                            <div><button class="btn btn-light-danger font-weight-bolder btn-sm" wire:click="deleteSubject({{ $key }})">حذف</button></div>
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>
        </div>
    </div>
</div>
