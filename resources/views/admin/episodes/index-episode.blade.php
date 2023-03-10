<div>
    @section('title','درس ها ')
    <x-admin.form-control link="{{ route('admin.store.episode',['create'] ) }}"  title="درس ها"/>
    <div class="card card-custom">
        <div class="card-body">
            <x-admin.forms.select2 id="course" :data="$data['course']" label="فیلتر بر حسب دوره اموزشی" wire:model.defer="course"/>
            <x-admin.forms.select2 id="chapter" :data="$data['chapter']" label="فیلتر بر حسب فصل " wire:model.defer="chapter"/>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان درس</th>
                            <th>عنوان دوره</th>
                            <th>عنوان فصل</th>
                            <th>تاریخ انتشار</th>
                            <th>اخرین اپدیت</th>
                            <th>فضای ذخیره سازی فایل</th>
                            <th>فضای ذخیره سازی ویدئو</th>
                            <th>امکان ارسال تمرین</th>
                            <th>تعداد تمرین</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($episodes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    {{ $item->chapter->course->title ?? '' }}
                                </td>
                                <td>
                                    {{ $item->chapter->title ?? '' }}
                                </td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                <td>{{ $item->file_storage_label }}</td>
                                <td>{{ $item->video_storage_label }}</td>
                                <td>{{ $item->can_homework ? 'دارد' : 'ندارد' }}</td>
                                <td>{{ $item->homeworks_count }}</td>
                                <td>{{ $item->free ? 'رایگان' : 'نقدی' }}</td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.episode',['edit', $item->id]) }}" />
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
