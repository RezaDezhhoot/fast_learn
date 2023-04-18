<div>
    @section('title',' فرم ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف فرم" mode="{{$mode}}" title="فرم" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input  type="text" id="title" label="عنوان*" wire:model.defer="title"/>
            </div>
            <x-admin.form-section label="سوالات">
                @foreach($items as $key => $item)
                    <div class="col-12 m-4 p-2 border rounded">
                        <x-admin.button class="btn btn-light-danger font-weight-bolder btn-sm" content="حذف سوال" wire:click="deleteItems({{$key}})" />
                        <x-admin.forms.input type="text" id="{{$key}}title" label=" سوال" wire:model.defer="items.{{$key}}.title"/>
                        <x-admin.form-section label="گزینه ها">
                            <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن گزینه" wire:click="addChoice({{$key}})" />
                            <div class="row">
                                @foreach(@$item['items'] as $itemKey => $choices)
                                    <div class="col-4 col-md-1 align-items-center d-flex ">
                                        <x-admin.forms.input type="text" id="items.{{$key}}.items.{{$itemKey}}.title" label=" عنوان گزینه" wire:model.defer="items.{{$key}}.items.{{$itemKey}}.title"/>
                                        <i class="flaticon2-trash text-danger" wire:click="deleteChoice({{$key}},{{$itemKey}})" ></i>
                                    </div>
                                @endforeach
                            </div>
                        </x-admin.form-section>
                    </div>
                @endforeach
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن سوال" wire:click="addItem()" />
            </x-admin.form-section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف فرم!',
                text: 'آیا از حذف این فرم اطمینان دارید؟',
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
        function deleteFormItem(id) {
            Swal.fire({
                title: 'حذف فرم!',
                text: 'آیا از حذف فرم اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteForm', id)
                }
            })
        }
    </script>
@endpush
