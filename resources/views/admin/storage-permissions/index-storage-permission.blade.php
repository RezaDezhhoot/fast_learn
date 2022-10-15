<div>
    @section('title','قوانین فضا های ذخیره سازی ')
    <x-admin.form-control link="{{ route('admin.store.acl',['create'] ) }}"  title="قوانین فضا های ذخیره سازی"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="storage" :data="$data['storage']" label="دیسک" wire:model="storage"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>دیسک</th>
                            <th>کد کاربر</th>
                            <th>نام کاربر</th>
                            <th>شماره کاربر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($acl as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->storage->name }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.acl',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="7">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$acl->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف !',
                text: 'آیا از حذف اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {

                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
