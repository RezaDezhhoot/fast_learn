<div>
    @section('title','فصل')
    <x-admin.form-control deleteAble="true" deleteContent="حذف درس" mode="{{$mode}}" title="فصل" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.select2 with="6" id="course" :data="$data['course']" label=" دوره آموزشی*"
                                       wire:model.defer="course" />
                <x-admin.forms.input with="6" type="number" id="view" label="نمایش *" wire:model.defer="view" />
                <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteHomeworks(id) {
            Swal.fire({
                title: 'حذف تمرین!',
                text: 'آیا از حذف این تمرین اطمینان دارید؟',
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
                            'تمرین مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteHomeworks', id)
                }
            })
        }

        function deleteItem(id) {
            Swal.fire({
                title: 'حذف درس!',
                text: 'آیا از حذف این درس اطمینان دارید؟',
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
                            'درس مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
