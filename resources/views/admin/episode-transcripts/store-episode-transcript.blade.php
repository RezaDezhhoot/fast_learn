<div>
    @section('title','رونوشت')
    <x-admin.form-control deleteAble="true" deleteContent="حذف رونوشت" mode="{{$mode}}" title="رونوشت" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>عنوان درس</th>
                            <th>عنوان دوره</th>
                            <th>لینک</th>
                            <th>فایل</th>
                            <th>ویدئو</th>
                            <th>زمان</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $episode->title }}</td>
                            <td>{{ $episode->course->title }}</td>
                            <td>
                                @if(!empty($episode->link))
                                    <a target="_blank" href="{{$episode->link}}">مشاهده</a>
                                @endif
                            </td>
                            <td>
                                @if(!empty($episode->file))
                                    {{ $episode->file_storage_label }} :
                                    <button wire:click="download('{{$episode->file}}','file')" class="btn btn-sm btn-outline-success"> دانلود فایل ({{$episode->file}})</button>
                                @endif
                            </td>
                            <td>
                                @if(!empty($episode->local_video))
                                    {{ $episode->video_storage_label }} :
                                    <button wire:click="download('{{$episode->local_video}}','video')" class="btn btn-sm btn-outline-success"> دانلود ویدئو ({{$episode->local_video}})</button>
                                @endif
                            </td>
                            <td>{{$episode->time}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>نمایش</th>
                                <th>نمایش ویدئو api</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$episode->view}}</td>
                                <td>{{$episode->show_api_video ? 'بله' : 'خیر'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>کد اشتراک گذاری api</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                @if(!empty($episode->api_bucket))
                                    {!! $episode->api_bucket !!}
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>نمایش ویدئو</th>
                            <th>دانلود ویدئو</th>
                            <th>امکان بارگذاری تمرین</th>
                            <th>فضای ذخیره سازی تمرین</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$episode->allow_show_local_video ? 'بله' : 'خیر'}}</td>
                            <td>{{$episode->downloadable_local_video ? 'بله' : 'خیر'}}</td>
                            <td>{{$episode->can_homework ? 'بله' : 'خیر'}}</td>
                            <td>
                                <x-admin.forms.dropdown id="homework_storage" :data="$data['storage']" label="  فضای ذخیره سازی تمرین"
                                                        wire:model.defer="homework_storage" />
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <x-admin.forms.text-area disabled label=" توضیحات مدرس"  wire:model.defer="description" id="description" />
                <x-admin.forms.checkbox value="1" id="free" label="رایگان " wire:model.defer="free" />
                <x-admin.forms.dropdown  id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.full-text-editor id="message" label="نتیجه نهایی*" wire:model.defer="message"/>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف رونوشت!',
                text: 'آیا از حذف این رونوشت اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
