<div>
    @section('title','کاربران ')
    <x-admin.form-control link="{{ route('admin.store.user',['create'] ) }}" title="کاربران"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.dropdown id="status" :data="$data['roles']" label="نقش" wire:model="roles"/>
            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                @include('admin.layouts.advance-table')
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table class="table table-striped table-bordered" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کد</th>
                                <th> نام</th>
                                <th>شماره همراه</th>
                                <th>موجودی کیف پول(تومان)</th>
                                <th>وضعیت</th>
                                <th>مشاهده لاگ های این کاربر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ number_format( $item->balance)  }} تومان</td>
                                    <td>{{ $item->status_label }}</td>
                                    <td>
                                        <a href="{{route('admin.log',['user'=>$item->id])}}">مشاهده</a>
                                    </td>
                                    <td>
                                        <x-admin.edit-btn href="{{ route('admin.store.user',['edit', $item->id]) }}" />
                                        <x-admin.ok-btn wire:click="confirm({{$item->id}})" />
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
            </div>
            {{$users->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
