<div>
    @section('title','نمونه سوالات')
    <x-teacher.form-control link="{{ route('teacher.store.samples',['create'] ) }}" confirmContent="تعریف نمونه سوال جدید" title="نمونه سوالات"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-teacher.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
            <x-teacher.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('teacher.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> عنوان</th>
                            <th> دوره اموزشی</th>
                            <th>وضعیت</th>
                            <th>نوع</th>
                            <th>تعداد دانلود</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($samples as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->course->title ?? 'بدون دوره' }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ $item->type_label }}</td>
                                <td>{{ $item->downloads }}</td>
                                <td>
                                    <x-teacher.edit-btn href="{{ route('teacher.store.samples',['edit', $item->id]) }}" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="12">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$samples->links('teacher.layouts.paginate')}}
        </div>
    </div>
</div>

