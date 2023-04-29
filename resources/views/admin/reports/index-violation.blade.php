<div>
    @section('title','گزارش ایرادات ')
    <x-admin.form-control  title="گزارش ایرادات"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره آموزشی" wire:model.defer="course"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>موضوع گزارش</th>
                            <th>توسط</th>
                            <th>وضعیت</th>
                            <th>دوره آموزشی </th>
                            <th>درس مربوطه </th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{$item->subject}}</td>
                                <td>
                                    <ul>
                                        <li> کد کاربر  : {{ $item->user->id }}</a></li>
                                        <li> نام کامل : <a title="صفحه جزئیات کاربر"
                                                           href="{{route('admin.store.user',['edit', $item->user->id])}}">{{
                                                $item->user->name }}</a></li>
                                        <li>ادرس ایمیل : {{ $item->user->email }}</li>
                                        <li>شماره همراه : {{ $item->user->phone }}</li>
                                        <li>ای پی : {{ $item->user->ip }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->checked ? 'بررسی شده' : 'جدید' }}</td>
                                <td>{{ @$item->episode->chapter->course->title ?? '' }}</td>
                                <td>{{ @$item->episode->title ?? '' }}</td>
                                <td>
                                    <x-admin.ok-btn wire:click="checked({{$item->id}})" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="15">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$items->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف گزارش!',
                text: 'آیا از حذف این گزارش اطمینان دارید؟',
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
