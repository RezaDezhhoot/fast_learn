<div>
    @section('title','کد های تخفیف')
    <x-admin.form-control link="{{ route('admin.store.reduction',['create'] ) }}" title="کد های تخفیف"/>
    <div class="card card-custom">
        <div class="card-body">
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کد</th>
                            <th>نوع</th>
                            <th>مقدار</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reductions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->type_label}}</td>
                                <td>{{$item->amount}}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.reduction',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="5">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        <tr>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{$reductions->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف کد تخفیف!',
                text: 'آیا از حذف کد تخفیف اطمینان دارید؟',
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
