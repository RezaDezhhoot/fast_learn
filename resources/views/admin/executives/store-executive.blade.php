<div>
    @section('title','دستگاه اجرایی')
    <x-admin.form-control deleteAble="true" deleteContent="حذف دسستگاه اجرایی" mode="{{$mode}}" title="دسستگاه اجاریی"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        ِ<x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.lfm-standalone id="logo" label="لوگو*" :file="$logo" type="image" required="true" wire:model="logo"/>
            </div>
            <hr>
            <x-admin.form-section label="زیرمجموعه ها">
                <div class="border p-3">
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن " wire:click="addChild()" />
                    @foreach($child as $key => $item)
                        <div class="form-group d-flex align-items-center col-12">
                            <input class="form-control col-11" id="{{ $key }}child" type="text" placeholder="عنوان" wire:model.defer="child.{{$key}}.title">
                            <div><button class="btn btn-light-danger font-weight-bolder btn-sm" onclick="deleteChild({{ $key }})">حذف</button></div>
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
                title: 'حذف دستگاه اجرایی!',
                text: 'آیا از حذف این دستگاه اجرایس اطمینان دارید؟',
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
        function deleteChild(id) {
            Swal.fire({
                title: 'حذف دستگاه اجرایس !',
                text: 'آیا از حذف این دستگاه اجرایس اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteChild', id)
                }
            })
        }
    </script>
@endpush
