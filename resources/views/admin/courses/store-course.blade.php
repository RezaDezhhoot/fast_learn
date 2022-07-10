<div>
    @section('title','دوره  ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف دوره" mode="{{$mode}}" title="دوره" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-admin.forms.input with="6" disabled type="text" id="slug" label="نام مستعار*" wire:model.defer="slug"/>
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.input type="text" id="sub_title" label="عنوان فرعی*" wire:model.defer="sub_title"/>
                <x-admin.forms.dropdown  id="level" :data="$data['level']" label="سطح دوره*" wire:model.defer="level"/>
                <x-admin.forms.dropdown with="6" id="category" :data="$data['category']" label="دسته*" wire:model.defer="category"/>
                <x-admin.forms.input with="6" type="number" id="const_price" label="قیمت ثابت" wire:model.defer="const_price"/>
                <x-admin.forms.dropdown with="6" id="quiz" :data="$data['quiz']" label="ازمون" wire:model.defer="quiz"/>
                <x-admin.forms.input with="6" type="number" min="0" id="reduction_value" label="مقدار تخفیف*" wire:model.defer="reduction_value"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                <x-admin.forms.dropdown with="6" id="reduction_type" :data="$data['reduction']" label="نوع تخفیف" wire:model.defer="reduction_type"/>
                <x-admin.forms.date-picker with="6" id="start_at" label="شروع تخفیف" wire:model.defer="start_at"/>
                <x-admin.forms.date-picker with="6" id="expire_at" label="پایان تخفیف" wire:model.defer="expire_at"/>
            </div>
            <hr>
            <x-admin.forms.select2 id="teacher" :data="$data['teacher']" label="مدرس*" wire:model.defer="teacher"/>
            <x-admin.forms.full-text-editor id="short_body" label="توضیحات کوتاه*" wire:model.defer="short_body"/>
            <x-admin.forms.full-text-editor id="long_body" label="توضیحات کامل*" wire:model.defer="long_body"/>
            <x-admin.forms.lfm-standalone id="image" label="تصویر*" :file="$image" type="image" required="true" wire:model="image"/>
            <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
            <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />

            <x-admin.form-section label="سرفصل ها">
                <x-admin.modal-page id="episode" wire:click="storeEpisode()" title="{{ $modal_title }}">
                    <x-admin.forms.validation-errors/>
                    <x-admin.forms.input type="text" id="e_title" label="عنوان *" wire:model.defer="e_title"/>

                    <x-admin.form-section  label="فایل">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-bordered">
                                    <tbody class="col-12">
                                    <tr>
                                        <td>1- اپلود مستقیم</td>
                                        <td>
                                            <div class="form-group col-12 m-0">
                                                <label class="custom-file-label"  for="file">فایل</label>
                                                <div x-data="{ isUploading: false, progress: 0 }"
                                                     x-on:livewire-upload-start="isUploading = true"
                                                     x-on:livewire-upload-finish="isUploading = false"
                                                     x-on:livewire-upload-error="isUploading = false"
                                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <input type="file" id="file" class="custom-file-input" wire:model="file" aria-label="file" />

                                                    <div class="mt-2" x-show="isUploading">
                                                        در حال اپلود فایل...
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                </div>
                                                <br>
                                                @if(!is_null($file))
                                                    <p class="alert alert-success">
                                                        <small>فایل روی سرور</small>
                                                    </p>
                                                @endif
                                            </div>
                                            <p class="text text-info">
                                                {{ !is_null($file_site) ? 'اپلود شده مستقیم' : '' }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2- مسیر فایل</td>
                                        <td>
                                            <x-admin.forms.input help="برای فایل با حجم زیاد پیشنهاد می شود" type="text" id="file_path" label="مسیر" wire:model.defer="file_path"/>
                                            <p class="text text-info">
                                                {{ !is_null($file_path) ? 'اپلود شده توسط مسیر' : '' }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            فضای ذخیره سازی
                                        </td>
                                        <td>
                                            <x-admin.forms.dropdown id="e_file_storage" :data="$data['storage']" label="انتخاب" wire:model.defer="e_file_storage"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>عملیات</td>
                                        <td>
                                            @if(!is_null($e_file) && $e_key <> -1)
                                                <div>
                                                    <a wire:loading.attr="disabled" target="_blank" href="{{route('storage',[$e_id,'file'])}}" class="btn btn-light-success font-weight-bolder btn-sm">مشاهده فایل</a>
                                                    <button wire:click="deleteMedia('file')" wire:loading.attr="disabled" class="btn btn-outline-danger font-weight-bolder btn-sm">حذف فایل</button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </x-admin.form-section>

                    <x-admin.form-section label="ویدیو (مناسب برای دانلود)">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-bordered">
                                    <tbody class="col-12">
                                    <tr>
                                        <td>1- اپلود مستقیم</td>
                                        <td>
                                            <div class="form-group col-12 m-0">
                                                <label class="custom-file-label" for="video">ویدیو</label>
                                                <div x-data="{ isUploading: false, progress: 0 }"
                                                     x-on:livewire-upload-start="isUploading = true"
                                                     x-on:livewire-upload-finish="isUploading = false"
                                                     x-on:livewire-upload-error="isUploading = false"
                                                     x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                    <input type="file" class="custom-file-input" id="video" wire:model="video" aria-label="video" />

                                                    <div class="mt-2" x-show="isUploading">
                                                        در حال اپلود ویدیو...
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                </div>
                                                <br>
                                                @if(!is_null($video))
                                                    <p class="alert alert-success">
                                                        <small>ویدئو روی سرور</small>
                                                    </p>
                                                @endif

                                            </div>
                                            <p class="text text-info">
                                                {{ !is_null($video_site) ? 'اپلود شده مستقیم' : '' }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2- مسیر ویدیو</td>
                                        <td>
                                            <x-admin.forms.input help="برای فایل با حجم زیاد پیشنهاد می شود" type="text" id="video_path" label="مسیر" wire:model.defer="video_path"/>
                                            <p class="text text-info">
                                                {{ !is_null($video_path) ? 'اپلود شده توسط مسیر' : '' }}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            فضای ذخیره سازی
                                        </td>
                                        <td>
                                            <x-admin.forms.dropdown id="e_video_storage" :data="$data['storage']" label="انتخاب" wire:model.defer="e_video_storage"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>عملیات</td>
                                        <td>
                                            @if($e_local_video && $e_key <> -1)
                                                <a wire:loading.attr="disabled" target="_blank" href="{{route('storage',[$e_id,'video'])}}" class="btn btn-light-success font-weight-bolder btn-sm">مشاهده رسانه</a>
                                                <button wire:click="deleteMedia('video')" wire:loading.attr="disabled" class="btn btn-outline-danger font-weight-bolder btn-sm">حذف ویدئو</button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <x-admin.forms.checkbox value="1" id="e_allow_show_local_video"  label="امکان نمایش ویدئو " wire:model.defer="e_allow_show_local_video" />
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </x-admin.form-section>

                    <x-admin.forms.input type="url" id="e_link" label="لینک" wire:model.defer="e_link"/>
                    <x-admin.forms.text-area label="کد اشتراک گذاریapi (مناسب برای نمایش)" wire:model.defer="e_api_bucket" id="e_api_bucket" />
                    <x-admin.forms.input type="text" id="e_time" label="زمان *" wire:model.defer="e_time"/>
                    <x-admin.forms.input type="number" id="e_view" label="نمایش *" wire:model.defer="e_view"/>
                    <x-admin.forms.checkbox value="1" id="e_free"  label="رایگان " wire:model.defer="e_free" />
                </x-admin.modal-page>
                <x-admin.button class="primary" content="افزودن سرفصل" wire:click="addEpisode('new')" />
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($episodes as $key => $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value['title'] }}</td>
                            <td>
                                <button type="button" wire:click="addEpisode({{$key}})" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2">
                                    <span class="svg-icon svg-icon-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                                <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </button>
                                <x-admin.delete-btn onclick="deleteEpisode({{$key}})" />
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-admin.form-section>
            <x-admin.form-section label="تگ ها">
                <div class="row">
                    @foreach($data['tags'] as $key => $value)
                        <div class="col-3">
                            <x-admin.forms.checkbox value="{{$key}}" id="{{$key}}tag" label="{{$value}}" wire:model.defer="tags.{{$key}}" />
                        </div>
                    @endforeach
                </div>
            </x-admin.form-section>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف دوره!',
                text: 'آیا از حذف این دوره اطمینان دارید؟',
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
                            'دوره مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
        function deleteEpisode(id) {
            Swal.fire({
                title: 'حذف سرفصل!',
                text: 'آیا از حذف این سرفصل اطمینان دارید؟',
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
                            'سرفصل مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteEpisode', id)
                }
            })
        }
    </script>
@endpush
