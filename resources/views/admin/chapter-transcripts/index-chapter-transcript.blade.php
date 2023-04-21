<div>
    @section('title','رونوشت های فصل ها ')
    <x-admin.form-control  store="{{false}}" title="رونوشت های فصل ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره آموزشی" wire:model.defer="course"/>
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان فصل</th>
                            <th>عنوان دوره</th>
                            <th>مدرس</th>
                            <th>تاریخ انتشار</th>
                            <th>وضعیت</th>
                            <th>بروزرسانی/فصل جدید</th>
                            <th>اعمال شده</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($chapters as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @isset($item->course)
                                        <a href="{{ route('admin.store.course',['edit',$item->course->id]) }}">
                                            {{ $item->course->title }}
                                        </a>
                                    @endisset
                                </td>
                                <td>{{ $item->course->teacher->user->name ?? '' }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ is_null($item->chapter) ? 'فصل جدید' : 'ارسال بروزرسانی' }}</td>
                                <td>{{ $item->is_confirmed ? 'بله' : 'خیر' }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.chapterTranscript',['edit', $item->id]) }}" />
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
            {{$chapters->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
