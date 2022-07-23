<div>
    @section('title','درس')
    <x-admin.form-control deleteAble="true" deleteContent="حذف درس" mode="{{$mode}}" title="درس" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان *" wire:model.defer="title" />
                <x-admin.forms.input with="6" type="url" id="link" label="لینک" wire:model.defer="link" />
                <x-admin.forms.input with="6" type="text" id="time" label="زمان *" wire:model.defer="time" />
                <x-admin.forms.input with="6" type="number" id="view" label="نمایش *" wire:model.defer="view" />
                <x-admin.forms.select2 id="course_id" :data="$data['course']" label=" دوره اموزشی"
                    wire:model.defer="course_id" />
                <x-admin.forms.checkbox value="1" id="free" label="رایگان " wire:model.defer="free" />
                <x-admin.forms.checkbox value="1" id="can_homework" label="امکان بارگذاری تمرین "
                    wire:model.defer="can_homework" />
                <x-admin.forms.dropdown id="homework_storage" :data="$data['storage']" label="  فضای ذخیره سازی تمرین"
                    wire:model.defer="homework_storage" />
                <x-admin.forms.text-area label="کد اشتراک گذاریapi " wire:model.defer="api_bucket" id="api_bucket" />
                <x-admin.forms.checkbox value="1" id="show_api_video"
                                        label="نمایش ویدئو " wire:model.defer="show_api_video" />
                <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
                <x-admin.form-section class="col-12" label="فایل">
                    <table class=" table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <x-admin.forms.dropdown id="file_storage" :data="$data['storage']"
                                        label="  فضای ذخیره سازی فایل" wire:model.defer="file_storage" />
                                </td>
                                <td>
                                    <x-admin.forms.lfm-standalone id="file" label="فایل" :file="$file" type="image"
                                        required="true" wire:model="file" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </x-admin.form-section>
                <x-admin.form-section class="col-12" label="ویدئو">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <x-admin.forms.dropdown id="video_storage" :data="$data['storage']"
                                        label=" فضای ذخیره سازی ویدئو" wire:model.defer="video_storage" />
                                </td>
                                <td>
                                    <x-admin.forms.lfm-standalone id="local_video" label="ویدئو" :file="$local_video"
                                        type="image" required="true" wire:model="local_video" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <x-admin.forms.checkbox value="1" id="allow_show_local_video"
                                        label="امکان نمایش ویدئو " wire:model.defer="allow_show_local_video" />
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">
                                    <x-admin.forms.checkbox value="1" id="downloadable_local_video"
                                        label="امکان دانلود ویدئو " wire:model.defer="downloadable_local_video" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </x-admin.form-section>
                @if(!is_null($episode))
                <x-admin.form-section class="col-12" label="تمرین ها">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام کاربر</th>
                                    <th>شماره کاربر</th>
                                    <th>ایمیل کاربر</th>
                                    <th>عنوان درس</th>
                                    <th>فضای ذخیره سازی</th>
                                    <th>امتیاز</th>
                                    <th>بررسی استاد</th>
                                    <th>تاریخ</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($homeworks as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->phone }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->episode_title }}</td>
                                    <td>{{ $item->storage_label }}</td>
                                    <td>{{ $item->score }}</td>
                                    <td>{{ !is_null($item->result) ? 'بله' : 'خیر' }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        <x-admin.edit-btn wire:click="openHomework('{{$item->id}}')" />
                                        <x-admin.delete-btn onclick="deleteHomeworks({{$item->id}})" />
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
                    {{$homeworks->links('admin.layouts.paginate')}}
                </x-admin.form-section>
                @endif
            </div>
        </div>
    </div>
    <x-admin.modal-page id="homework" title="تمرین" wire:click="storeHomework">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>نام کاربر</th>
                        <th>شماره کابر</th>
                        <th>ایمیل کاربر</th>
                        <th>فضای ذخیره سازی</th>
                        <th>درس</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $homework->user->name ?? '' }}</td>
                        <td>{{ $homework->user->phone ?? '' }}</td>
                        <td>{{ $homework->user->email ?? '' }}</td>
                        <td>{{ $homework->storage_label ?? '' }}</td>
                        <td>{{ $homework->episode_title?? '' }}</td>

                        <td>{{ $homework ? $homework->created_at->diffForHumans() : '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <x-admin.forms.text-area disabled label=" توضیحات کاربر" wire:model.defer="h_description"
                id="h_description" />
            <x-admin.form-section label="فایل">
                @if(!empty($h_file))
                <button wire:click="download()" class="btn btn-sm btn-outline-warning">دانلود فایل</button>
                <button wire:click="deleteHFile()" class="btn btn-sm btn-outline-danger">حذف فایل</button>
                @endif
            </x-admin.form-section>
            <x-admin.form-section label="نتیجه">
                <x-admin.forms.basic-text-editor id="h_result" label="توضیحات مدرس*" wire:model.defer="h_result" />
                <x-admin.forms.input max="5" min="1" type="number" help="از 1 تا 5" id="h_score" label="امتیاز *"
                    wire:model.defer="h_score" />
            </x-admin.form-section>
        </div>
    </x-admin.modal-page>
</div>
@push('scripts')
<script>
    function deleteHomeworks(id) {
            Swal.fire({
                title: 'حذف تمرین!',
                text: 'آیا از حذف این تمرین اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'تمرین مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteHomeworks', id)
                }
            })
        }

        function deleteItem(id) {
            Swal.fire({
                title: 'حذف درس!',
                text: 'آیا از حذف این درس اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'درس مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
</script>
@endpush