<div>
    @section('title','فصل ها ')
    <x-admin.form-control link="{{ route('admin.store.chapter',['create'] ) }}"  title="فصل ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
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
                            <th>دوره اموزشی </th>
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
                                <td>{{ $item->course->title ?? '' }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.chapter',['edit', $item->id]) }}" />
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
            {{$items->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
