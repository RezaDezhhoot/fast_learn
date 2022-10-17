<div>
    @section('title','کارنامه ها ')
    <x-admin.form-control link="{{ route('admin.store.transcript',['create'] ) }}" title="کارنامه ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="result" :data="$data['result']" label="نتیجه" wire:model="result"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره کارنامه</th>
                            <th>شماره گواهینامه</th>
                            <th>کد کاربر</th>
                            <th>نام کاربر</th>
                            <th>شماره کاربر</th>
                            <th>دوره</th>
                            <th>ازمون</th>
                            <th>نتیجه</th>
                            <th>نمره</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transcripts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->certificate_code ?? '' }}</td>
                                <td>{{ $item->user->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->phone }}</td>
                                <td>{{ $item->course_data['title'] }}</td>
                                <td>{{ $item->quiz->name }}</td>
                                <td>{{ $item->result_label }}</td>
                                <td>{{ $item->score }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.transcript',['edit', $item->id]) }}" />
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
            {{$transcripts->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف کارنامه!',
                text: 'آیا از حذف این کارنامه اطمینان دارید؟',
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
                            'کارنامه مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
