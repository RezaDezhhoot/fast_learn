<div>
    @section('title','لاگ های کاربر ')
    <x-admin.form-control store="{{false}}" title="لاگ های کاربر"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="type" :data="$data['subject']" label="موضوع کاربر " wire:model="subject"/>
            <x-admin.forms.input type="text" id="user" label="شماره همراه یا شماره شناسه کاربر" wire:model="user" />
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>توسط</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                            <th>موضوع کاربر</th>
                            <th> جزئیات موضوع</th>
                            <th>جزئیات بیشتر</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($logs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <ul>
                                        <li> شماره شناسه : {{ $item->causer->id }}</a></li>
                                        <li> نام کامل : <a title="صفحه جزئیات کاربر" href="{{route('admin.store.user',['edit', $item->causer->id])}}">{{ $item->causer->name }}</a></li>
                                        <li>ادرس ایمیل : {{ $item->causer->email }}</li>
                                        <li>شماره همراه : {{ $item->causer->phone }}</li>
                                        <li></li>
                                    </ul>
                                </td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->event_label }}</td>
                                <td>{{ $item->subject_label }}</td>
                                <td>
                                    @if($item->subject_type == \App\Enums\PaymentEnum::user())
                                    <ul>
                                        <li> شماره شناسه : {{$item->subject->name}}</li>
                                        <li> نام کامل : <a title="صفحه جزئیات کاربر" href="{{route('admin.store.user',['edit', $item->subject->id])}}">{{ $item->subject->name }}</a></li>
                                        <li> ادرس ایمیل : {{$item->subject->email}}</li>
                                        <li> شماره همراه : {{$item->subject->phone}}</li>
                                    </ul>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="downloadDetails({{$item->id}})" class="btn btn-success btn-sm">
                                        دانلود
                                    </button>
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
            {{$logs->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
