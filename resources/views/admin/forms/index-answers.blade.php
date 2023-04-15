<div>
    @section('title',' فرم های ارسالی')
    <x-admin.form-control store="{{false}}" title="فرم های ارسالی"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="subject" :data="$data['subject']" label="موضوع" wire:model="subject"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>تاریخ</th>
                            <th>فرم</th>
                            <th>موضوع</th>
                            <th>وضیعت</th>
                            <th>IP کاربر</th>
                            <th>کاربر</th>
                            <th>جزئیات</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <ul>
                                        <li>عنوان : {{ $item->form_details['form_title'] }}</li>
                                        <li>ID : {{ $item->form_details['form_id'] }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->subject_label }}</td>
                                <td>{{ $item->status ? 'بررسی شده' : 'جدید' }}</td>
                                <td>{{ $item->user_ip }}</td>


                                <td>
                                    @if (!is_null($item->user))
                                        <ul>
                                            <li> کد کاربر  : {{ $item->user->id }}</a></li>
                                            <li> نام کامل : <a title="صفحه جزئیات کاربر"
                                                               href="{{route('admin.store.user',['edit', $item->user->id])}}">{{
                                                $item->user->name }}</a></li>
                                            <li>ادرس ایمیل : {{ $item->user->email }}</li>
                                            <li>شماره همراه : {{ $item->user->phone }}</li>
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    @if($item->rating)
                                        <strong>دوره اموزشی</strong>
                                        <ul>
                                            <li>شناسه : {{ $item->rating->course->id ?? '' }}</li>
                                            <li>عنوان : {{ $item->rating->course->title ?? '' }}</li>
                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.answer',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="13">
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
                title: 'حذف فرم!',
                text: 'آیا از حذف این فرم اطمینان دارید؟',
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
