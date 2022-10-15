<div>
    @section('title','قوانین فضا دخیره سازی ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف" mode="{{$mode}}" title="قوانین  فضا دخیره سازی "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            @if(self::UPDATE_MODE == $mode)
            <x-admin.form-section label="کاربر">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>کد کاربر</th>
                                <td>نام</td>
                                <td>شماره همراه</td>
                                <td>وضعیت</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $user_data->id }}</td>
                                <td>{{ $user_data->name }}</td>
                                <td>{{ $user_data->phone }}</td>
                                <td>{{ $user_data->status_label }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-admin.form-section>
            @endif
            <div class="row">
                <x-admin.forms.input with="6" type="number" id="name" label="کد کاربری *" wire:model.defer="user"/>
                <x-admin.forms.dropdown with="6" id="storage" :data="$data['storage']" label="دیسک" wire:model.defer="storage"/>

            </div>
                <x-admin.form-section label=" مسیر ها : ">
                   <div>
                       <button wire:click="addPath" class="btn btn-sm btn-outline-info">فزودن مسیر</button>
                       <div class="col-12 p-0 m-0 mt-4">
                           <table class="table table-striped table-bordered">
                               <thead>

                               </thead>
                               <tbody>
                               @foreach($path as $key => $item)
                                   <tr>
                                       <td>
                                           <x-admin.forms.dropdown  id="path.{{$key}}.access" :data="$data['access']" label="سطح دسترسی*" wire:model.defer="path.{{$key}}.access"/>
                                       </td>
                                       <td>
                                           <x-admin.forms.input class="text-right" dir="ltr" type="text" id="path.{{$key}}.path" label="مسیر*" wire:model.defer="path.{{$key}}.path"/>
                                       </td>
                                       <td >
                                           <button wire:click="deletePath('{{$key}}')" class="btn btn-sm mt-5 btn-outline-danger">حذف مسیر</button>
                                       </td>
                                   </tr>
                               @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
                </x-admin.form-section>
            <x-admin.form-section label="راهنمایی مسیر دهی : ">
                <ul dir="ltr" class="text-right">
                    <li>* - all files and folders</li>
                    <li>folder-name</li>
                    <li>folder1* - select folder1, folder12, folder1/sub-folder, ...</li>
                    <li>folder2/* - select folder2/sub-folder,... but not select folder2 !!!</li>
                    <li>folder-name/file-name.jpg</li>
                    <li>folder-name/*.jpg</li>
                </ul>
            </x-admin.form-section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem() {
            Swal.fire({
                title: 'حذف !',
                text: 'آیا از حذف  اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteItem')
                }
            })
        }
    </script>
@endpush
