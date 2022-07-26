<div>
    @section('title','دوره ها ')
    <x-admin.form-control link="{{ route('admin.store.course',['create'] ) }}"  title="دوره ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.dropdown id="category" :data="$data['category']" label="دسته بندی" wire:model="category"/>
            <x-admin.forms.dropdown id="type" :data="$data['type']" label="نوع دوره" wire:model="type"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>نام مستعار</th>
                            <th>عنوان</th>
                            <th>وضعیت</th>
                            <th>نوع دوره</th>
                            <th>بازدید</th>
                            <th>دسته </th>
                            <th>قیمت </th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($courses as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>{{ $item->views }}</td>
                                <td>{{ $item->category->title ?? null }}</td>
                                <td>{{ number_format($item->price) }} تومان </td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.course',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="11">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$courses->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
