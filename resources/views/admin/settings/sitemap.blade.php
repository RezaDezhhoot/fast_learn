<div>
    @section('title','نقشه سایت')
    <x-admin.form-control  title="تنظیمات نقشه سایت "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">تنظیمات نقشه سایت</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="pt-1">
                <x-admin.loader wire:target="store" text="فرایند در حال اجرا" />
            </div>
            <div class="row">
                <x-admin.forms.checkbox value="1"  id="home" name="home" label="صفحه اصلی" wire:model.defer="home" />
                <x-admin.forms.checkbox value="1" help="دوره های پیشنویس را شامل نمی شود" id="courses" name="courses" label="شامل دورها" wire:model.defer="courses" />
                <x-admin.forms.checkbox value="1" help="مفالات پیشنویس را شامل نمی شود" id="articles" name="articles" label="شامل مقالات" wire:model.defer="articles" />
                <x-admin.forms.checkbox value="1" help="شامل صفحات درباره ما ، ارتباط با ما و ..." id="settings" name="settings" label="سایر صفحات" wire:model.defer="settings" />
            </div>
            <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن صفخه" wire:click="addRow('pages')" />
            @foreach($pages as $key => $item)
                <div class="form-group d-flex align-items-center col-12">
                    <input class="form-control col-11" id="pages{{ $key }}" type="text" placeholder="ادرس" wire:model.defer="pages.{{$key}}">
                    <div><button class="btn btn-light-danger font-weight-bolder btn-sm" wire:click="deleteRow('pages',{{ $key }})">حذف</button></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
