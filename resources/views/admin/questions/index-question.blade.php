<div>
    @section('title','سوالات')
    <x-admin.form-control link="{{ route('admin.store.question',['create'] ) }}"  title="سوالات"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="category" :data="$data['categories']" label="دسته بندی" wire:model="category"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام </th>
                            <th>منبع</th>
                            <th>سطح</th>
                            <th>دسته</th>
                            <th>نمره</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($questions as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->source }}</td>
                                <td>{{ $item->difficulty_label }}</td>
                                <td>{{ $item->category->title ?? '' }}</td>
                                <td>{{ $item->score }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.question',['edit', $item->id]) }}" />
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
            {{$questions->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف سوال!',
                text: 'آیا از حذف این سوال اطمینان دارید؟',
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
                            'سوال مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
