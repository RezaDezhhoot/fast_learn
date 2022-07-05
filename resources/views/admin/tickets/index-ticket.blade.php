<div>
    @section('title',' تیکت ها ')
    <x-admin.form-control link="{{ route('admin.store.ticket',['create'] ) }}"  title="تیکت ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.dropdown id="priority" :data="$data['priority']" label="الویت" wire:model="priority"/>
            <x-admin.forms.dropdown id="subject" :data="$data['subject']" value="true" label="موضوع" wire:model="subject"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive table-bordered">
                    <table  class="table table-striped" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره</th>
                            <th> موضوع</th>
                            <th>کاربر هدف</th>
                            <th>فرستنده</th>
                            <th>وضعیت</th>
                            <th>اولویت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tickets as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->senderTypeLabel }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->priority_label }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.ticket',['edit', $item->id]) }}" />
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
            {{$tickets->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف تیکت!',
                text: 'آیا از حذف این تیکت اطمینان دارید؟',
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
                            'تیکت مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
