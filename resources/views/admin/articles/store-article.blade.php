<div>
    @section('title',' مقاله ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف مقاله" mode="{{$mode}}" title="مقاله" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" disabled id="slug" label="نام مستعار" wire:model.defer="slug"/>
                <x-admin.forms.dropdown with="6" id="category" :data="$data['category']" label="دسته*" wire:model.defer="category"/>
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            </div>
            <hr>
            <x-admin.forms.lfm-standalone id="image" label="تصویر" :file="$image" type="image" required="true" wire:model="image"/>
            <x-admin.forms.full-text-editor id="body" label="محتوا*" wire:model.defer="body"/>
            <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
            <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />
            <x-admin.form-section label="نویسنده">
                <x-admin.forms.input type="text"  id="author_name" label="نام نویسنده" wire:model.defer="author_name"/>
                <x-admin.forms.lfm-standalone id="author_image" label="تصویر نویسنده" :file="$author_image" type="image" required="true" wire:model="author_image"/>
                <x-admin.forms.full-text-editor id="author_info" label="درباره نویسنده" wire:model.defer="author_info"/>
            </x-admin.form-section>
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
                title: 'حذف مقاله!',
                text: 'آیا از حذف این مقاله اطمینان دارید؟',
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
                            'مقاله مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
