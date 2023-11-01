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
                <div id="accordion">
                    @foreach($items as $key => $item)
                        <div class="card my-2">
                            <div class="card-header p-0 m-0" id="heading{{$key}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                        سوال {{ $loop->iteration }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapse{{$key}}" class="collapse" wire:ignore.self aria-labelledby="heading{{$key}}" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row m-0 p-0">
                                        <div class="d-flex justify-content-end align-items-end col-11">
                                            <x-admin.forms.input type="text" id="{{$key}}title" label=" سوال" wire:model.defer="items.{{$key}}.title"/>
                                            <x-admin.button class="btn btn-light-danger font-weight-bolder btn-sm" content="حذف " wire:click="deleteItems({{$key}})" />
                                        </div>
                                        <div class="col-12 p-0 m-0">
                                            <x-admin.form-section label="گزینه ها">
                                                <div class="row">
                                                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن گزینه" wire:click="addChoice({{$key}})" />
                                                    <table class="table table-separate">
                                                        <tr>
                                                            @foreach(@$item['items'] as $itemKey => $choices)
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="flaticon2-trash text-danger cursor-pointer" wire:click="deleteChoice({{$key}},{{$itemKey}})" ></i>
                                                                        <x-admin.forms.input type="text" id="items.{{$key}}.items.{{$itemKey}}.title" label=" عنوان گزینه" wire:model.defer="items.{{$key}}.items.{{$itemKey}}.title"/>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </table>
                                                </div>
                                            </x-admin.form-section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                    <x-admin.button class="btn mt-2 btn-light-primary font-weight-bolder btn-sm" content="افزودن سوال" wire:click="addItem()" />
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
