<div>
    @section('title','دوره  ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف دوره" mode="{{$mode}}" title="دوره" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" disabled type="text" id="slug" label="نام مستعار*" wire:model.defer="slug"/>
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.input type="text" id="sub_title" label="عنوان فرعی*" wire:model.defer="sub_title"/>
                <x-admin.forms.dropdown with="6" id="level" :data="$data['level']" label="سطح دوره*" wire:model.defer="level"/>
                <x-admin.forms.dropdown with="6" id="type" :data="$data['type']" label="نوع دوره*" wire:model.defer="type"/>
                <x-admin.forms.dropdown with="6" id="category" :data="$data['category']" label="دسته*" wire:model.defer="category"/>
                <x-admin.forms.input with="6" type="number" id="const_price" label="قیمت ثابت" wire:model.defer="const_price"/>
                <x-admin.forms.dropdown with="6" id="quiz" :data="$data['quiz']" label="ازمون" wire:model.defer="quiz"/>
                <x-admin.forms.input with="6" type="number" min="0" id="reduction_value" label="مقدار تخفیف*" wire:model.defer="reduction_value"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.dropdown with="6" id="reduction_type" :data="$data['reduction']" label="نوع تخفیف" wire:model.defer="reduction_type"/>
                <x-admin.forms.jdate-picker with="6" id="start_at" label="شروع تخفیف" wire:model.defer="start_at"/>
                <x-admin.forms.jdate-picker with="6" id="expire_at" label="پایان تخفیف" wire:model.defer="expire_at"/>
                <x-admin.forms.lfm-standalone with="6" id="time_lapse" label="تایم لپس دوره" :file="$time_lapse" type="image" required="true" wire:model="time_lapse"/>
            </div>
            <hr>
            <x-admin.forms.select2 id="incomingMethod" :data="$data['incoming']" label="روش محاسبه درامد مدرس" wire:model.defer="incomingMethod"/>
            <x-admin.forms.select2 id="organ_id" :data="$data['organs']" label="سازمان یا اموزشگاه" wire:model.defer="organ_id"/>
            <x-admin.forms.select2 id="teacher" :data="$data['teacher']" label="مدرس*" wire:model.defer="teacher"/>
            <x-admin.forms.full-text-editor id="short_body" label="توضیحات کوتاه*" wire:model.defer="short_body"/>
            <x-admin.forms.full-text-editor id="long_body" label="توضیحات کامل*" wire:model.defer="long_body"/>
            <x-admin.forms.lfm-standalone id="image" label="تصویر*" :file="$image" type="image" required="true" wire:model="image"/>
            <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
            <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />
            <x-admin.form-section label="تگ ها">
                <div class="row">
                    @foreach($data['tags'] as $key => $value)
                        <div class="col-3">
                            <x-admin.forms.checkbox value="{{$key}}" id="{{$key}}tag" label="{{$value}}" wire:model.defer="tags.{{$key}}" />
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف دوره!',
                text: 'آیا از حذف این دوره اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'دوره مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
