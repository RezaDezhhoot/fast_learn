<div>
    @section('title','روش های محاسبه درامد')
    <x-admin.form-control link="{{ route('admin.store.incoming',['create'] ) }}"  title="روش های محاسبه درامد "/>
    <div class="card card-custom">
        <div class="card-body">
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان </th>
                            <th>درصد </th>
                            <th>محدودیت زمانی </th>
                            <th>محدودیت تعداد </th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($methods as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->value }}</td>
                                <td>{{ $item->expire_limit ? $item->expire_limit.' روز ' : 'ندارد' }}</td>
                                <td>{{ $item->count_limit ?? 'ندارد' }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.incoming',['edit', $item->id]) }}" />
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
            {{$methods->links('admin.layouts.paginate')}}
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
