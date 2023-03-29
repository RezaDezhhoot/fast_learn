<div>
    @section('title','سازمان ها')
    <x-organ.form-control store="{{false}}" title="سازمان ها"/>
    <div class="card card-custom">
        <div class="card-body">
            @include('organ.layouts.advance-table')
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
                            <th>وضعبت تغییر</th>
                            <th>تعداد دوره</th>
                            <th>درصد مشارکت</th>
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
                                <td>{{ @$item['info']['status'] ? 'بدون تفییر' : 'درخواست تغییر' }}</td>
                                <td>{{ $item->courses_count }}</td>
                                <td>{{ $item->percent ?? 0 }}</td>
                                <td>{{ $item->date }}</td>
                                <td>
                                    <x-organ.edit-btn href="{{ route('organ.store.settings',[$item->id]) }}" />
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
            {{$items->links('organ.layouts.paginate')}}
        </div>
    </div>
</div>
