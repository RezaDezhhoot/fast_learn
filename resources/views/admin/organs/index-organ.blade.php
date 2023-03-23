<div>
    @section('title','سازمان ها')
    <x-admin.form-control link="{{ route('admin.store.organ',['create'] ) }}" title="سازمان ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت " wire:model="status"/>
            <x-admin.forms.dropdown id="new_info" :data="$data['new_info']" label="درخواست بروزرسانی" wire:model="new_info"/>
            @include('admin.layouts.advance-table')
            <div class="row pb-3">
                <div class="form-group col-md-12 col-12">
                    <div class="d-flex justify-content-between col-12">
                        <div style="width: 50%;">
                            <label for="search">مدیر ارگان :</label>
                            <input id="search" type="text" class="form-control ml-1" placeholder="مدیر ارگان " wire:model="user">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>نام مستعار</th>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>مدیر</th>
                            <th>تعداد دوره</th>
                            <th>اموزشگاه جدید</th>
                            <th>تاریخ تاسیس</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>
                                    <ul>
                                        <li> کد کاربر  : {{ $item->user->id }}</a></li>
                                        <li> نام کامل : <a title="صفحه جزئیات کاربر"
                                                           href="{{route('admin.store.user',['edit', $item->user->id])}}">{{
                                                $item->user->name }}</a></li>
                                        <li>ادرس ایمیل : {{ $item->user->email }}</li>
                                        <li>شماره همراه : {{ $item->user->phone }}</li>
                                    </ul>
                                </td>
                                <td>{{ $item->course_count }}</td>
                                <td>{{ $item->is_new ? 'جدید' : 'قدیمی' }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.organ',['edit', $item->id]) }}" />
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
