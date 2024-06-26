<div>
    @section('title','دسته بندی ها')
    <x-admin.form-control link="{{ route('admin.store.category',['create'] ) }}" title="دسته بندی ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="type" :data="$data['type']" label="نوع " wire:model="type"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>نام مستعار</th>
                            <th>عنوان</th>
                            <th>دسته مادر</th>
                            <th>نوع دسته</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->parent->title ?? '' }}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.category',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="9">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$categories->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف دسته بندی!',
                text: 'آیا از حذف این دسته بندی اطمینان دارید؟',
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
                            'دسته بندی مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
