<div>
    @section('title',' درخواست های مدرس جدید')
    <x-admin.form-control  store="{{false}}"  title="درخواست های مدرس جدید"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد کاربر</th>
                            <th>نام</th>
                            <th>شماره همراه</th>
                            <th>ادرس ایمیل</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($requests as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.request',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="10">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{$requests->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف درخواست!',
                text: 'آیا از حذف این درخواست اطمینان دارید؟',
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
