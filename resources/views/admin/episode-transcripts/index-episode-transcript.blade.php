<div>
    @section('title','رونوشت ها ')
    <x-admin.form-control  store="{{false}}" title="رونوشت ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
            <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان درس</th>
                            <th>عنوان دوره</th>
                            <th>مدرس</th>
                            <th>تاریخ انتشار</th>
                            <th>فضای ذخیره سازی فایل</th>
                            <th>فضای ذخیره سازی ویدئو</th>
                            <th>امکان ارسال تمرین</th>
                            <th>وضعیت</th>
                            <th>بروزرسانی/درس جدید</th>
                            <th>اعمال شده</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($episodes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ route('admin.store.course',['edit',$item->course->id]) }}">
                                        {{ $item->course->title }}
                                    </a>
                                </td>
                                <td>{{ $item->course->teacher->user->name }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->file_storage_label }}</td>
                                <td>{{ $item->video_storage_label }}</td>
                                <td>{{ $item->can_homework ? 'دارد' : 'ندارد' }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>{{ is_null($item->episode) ? 'درس جدید' : 'ارسال بروزرسانی' }}</td>
                                <td>{{ $item->is_confirmed ? 'بله' : 'خیر' }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.episodeTranscript',['edit', $item->id]) }}" />
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
            {{$episodes->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
