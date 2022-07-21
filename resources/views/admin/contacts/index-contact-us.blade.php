<div>
    @section('title','ارتباط با ما')
    <x-admin.form-control store="{{false}}" title="ارتباط با ما"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="type" :data="$data['status']" label="وضعیت " wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کامل</th>
                            <th>ادرس ایمیل</th>
                            <th>شماره همراه</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>نحوه پاسخگویی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->full_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->action_label }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.contact',['edit', $item->id]) }}" />
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
            {{$contacts->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف دریف!',
                text: 'آیا از حذف این دریف اطمینان دارید؟',
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
