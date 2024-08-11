<div>
    @section('title',' پلن ربات ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف مقاله" mode="{{$mode}}" title="پلن ربات" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="4" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.input with="4" type="number" id="amount" label="مبلغ*" wire:model.defer="amount"/>
                <x-admin.forms.input with="4" type="number" id="profit" label="درامد*" wire:model.defer="profit"/>
                <x-admin.forms.lfm-standalone id="image" label="تصویر" :file="$image" type="image" required="true" wire:model="image"/>
                <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
            </div>
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
