<div>
    @section('title',' دستگاه های اجرایی ')
    <x-admin.form-control link="{{ route('admin.store.executive',['create'] ) }}" title="دستگاه های اجرایی"/>
    <div class="card card-custom">
        <div class="card-body">
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>عنوان</th>
                            <th>زیرمجموعه ها</th>
                            <th>دوره ها</th>
                            <th>کاربران</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($executives as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->child_count }}</td>
                                <td>{{ $item->courses_count }}</td>
                                <td>{{ $item->users_count }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.executive',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="11">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$executives->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف دستگاه اجرایی!',
                text: 'آیا از حذف این دستگاه اجرایی اطمینان دارید؟',
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
