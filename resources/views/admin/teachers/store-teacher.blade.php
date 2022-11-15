<div>
    @section('title','مدرس ')
    <x-admin.form-control mode="{{$mode}}" title="مدرس"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input type="text" id="sub_title" label="عنوان *" wire:model.defer="sub_title"/>
                <x-admin.forms.checkbox help="در صورت غیرفعال بودن این گزینه مدرس به پنل خود دسترسی نخواهد داشت و در صفحه مدریسن نمایش داده نمی شود" value="1" id="panel_status" label="دسترسی به پنل " wire:model.defer="panel_status" />
                <x-admin.forms.full-text-editor id="body" label="متن*" wire:model.defer="body"/>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف مدرس!',
                text: 'آیا از حذف این مدرس اطمینان دارید؟',
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
                            'مدرس مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
