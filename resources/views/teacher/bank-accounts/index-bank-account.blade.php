<div>
    @section('title','حساب های بانکی ')
    <x-teacher.form-control link="{{ route('teacher.store.bankAccounts',['create'] ) }}" confirmContent="تعریف حساب جدید"  title="حساب های بانکی"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-teacher.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('teacher.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>شماره حساب</th>
                            <th>شماره شبا</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($accounts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->card_number }}</td>
                                <td>{{ $item->sheba_number }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="12">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$accounts->links('teacher.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف حساب!',
                text: 'آیا از حذف این حساب اطمینان دارید؟',
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
