<div>
    @section('title','روش محاسبه درامد')
    <x-admin.form-control deleteAble="true" deleteContent="حذف روش" mode="{{$mode}}" title="روش محاسبه درامد" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-admin.forms.input min="0" with="6" type="number" id="value" help="میزان درصد مدرس" label="درصد *" wire:model.defer="value" />
                <x-admin.forms.input  min="1" type="number" id="count_limit"  label="حداکثر تعداد مجاز برای استقاده" wire:model.defer="count_limit" />
                <x-admin.forms.input  min="1" type="number" id="expire_limit" help="برحسب تعداد روز" label="حذاکثر زمان اعتبار این روش" wire:model.defer="expire_limit" />
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف روش!',
                text: 'آیا از حذف این روش اطمینان دارید؟',
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
