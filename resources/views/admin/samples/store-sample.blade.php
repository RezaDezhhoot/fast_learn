<div>
    @section('title','نمونه سوال')
    <x-admin.form-control deleteAble="true" deleteContent="حذف سوال" mode="{{$mode}}" title="نمونه سوال"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" disabled id="slug" label="نام مستعار" wire:model.defer="slug"/>
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.dropdown with="6" id="type" :data="$data['type']" label="نوع*" wire:model.defer="type"/>
                <x-admin.forms.dropdown with="6" id="driver" :data="$data['storage']" label="فضای ذخیره سازی*" wire:model.defer="driver"/>
                <div class="col-12">
                    <fieldset class="border p-4">
                        <legend>فایل </legend>
                        <x-admin.forms.lfm-standalone  id="file" label="فایل*" :file="$file"
                                                       type="image" required="true" wire:model="file" />

                        @if($mode == self::UPDATE_MODE)
                            <div class="form-group">
                                <button class="btn btn-sm btn-success" wire:click="download('{{$file}}')">دانلود فایل</button>
                            </div>
                        @endif
                    </fieldset>
                </div>
                <x-admin.forms.select2 id="course" :data="$data['course']" label=" دوره اموزشی"
                wire:model.defer="course" />
                <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
                <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />
                <x-admin.forms.full-text-editor id="description" label="توضیحات " wire:model.defer="description" />

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف سوال  !',
                text: 'آیا از حذف این سوال اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
