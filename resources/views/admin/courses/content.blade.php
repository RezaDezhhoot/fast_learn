<div class="container-fluid m-0 p-0 p-2">
    <div class="col-12">
        <div class="panel panel-default">

            <fieldset class="border p-2">
                <legend>
                    فصل جدید
                </legend>
                <x-admin.forms.validation-errors />
                <div class="row">
                    <x-admin.forms.input with="4" type="text" id="new_title" label="عنوان *" wire:model.defer="title" />
                    <x-admin.forms.dropdown with="4" id="new_status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                    <x-admin.forms.input with="4" type="number" id="new_view" label="نمایش *" wire:model.defer="view" />
                    <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="new_description" />
                </div>
                <button wire:click="saveChapter('new')" class="btn btn-sm btn-success">دخیره <i class="fa fa-save"></i></button>
            </fieldset>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>شماره شناسه</th>
                        <th>عنوان</th>
                        <th>دوره اموزشی </th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($chapters as $key => $item)
                        <tr data-toggle="collapse" data-target="#episodes{{$key}}" class="accordion-toggle cursor-pointer">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['id'] ?? '-' }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $course->title ?? '-' }}</td>
                            <td>
                                @if( !isset($item['has_transcript']) || ! $item['has_transcript'])
                                    <button wire:click="openChapter('{{$key}}')" class="btn btn-default btn-xs"><span class="text-primary flaticon2-settings"></span>
                                    </button>
                                @else
                                    <span class="text-info">در حال بررسی ...</span>
                                @endif

                                @if(! $transcript_view)
                                <button onclick="deleteChapter('{{$key}}')" class="btn btn-default btn-xs"><span class="text-danger flaticon2-trash"></span>
                                </button>
                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow">
                                <div wire:ignore.self class="accordian-body collapse" id="episodes{{$key}}">
                                    <fieldset class="border p-2">
                                        <legend>
                                            درس جدید
                                        </legend>
                                        <x-admin.forms.validation-errors />
                                        <div class="row">
                                            <x-admin.forms.input with="2" type="text" id="new_title{{$key}}" label="عنوان *" wire:model.defer="title" />
                                            <x-admin.forms.input with="2" type="url" id="new_link{{$key}}" label="لینک" wire:model.defer="link" />
                                            <x-admin.forms.input with="2" type="text" id="new_time{{$key}}" label="زمان *" wire:model.defer="time" />
                                            <x-admin.forms.input with="2" type="number" id="new_view{{$key}}" label="نمایش *" wire:model.defer="view" />
                                            <x-admin.forms.dropdown with="2"  id="new_homework_storage{{$key}}" :data="$data['storage']" label="  فضای ذخیره سازی تمرین"
                                                                     wire:model.defer="homework_storage" />
                                            <x-admin.forms.dropdown with="2" id="new_file_storage{{$key}}" :data="$data['storage']"
                                                                    label="  فضای ذخیره سازی فایل" wire:model.defer="file_storage" />
                                            <x-admin.forms.dropdown with="4" id="new_video_storage{{$key}}" :data="$data['storage']"
                                                                    label=" فضای ذخیره سازی ویدئو" wire:model.defer="video_storage" />
                                            <x-admin.forms.lfm-standalone with="4" id="new_file{{$key}}" label="فایل" :file="$file" type="image"
                                                                          required="true" wire:model="file" />
                                            <x-admin.forms.lfm-standalone with="4" id="new_local_video{{$key}}" label="ویدئو" :file="$local_video"
                                                                          type="image" required="true" wire:model="local_video" />


                                            <x-admin.forms.checkbox with="2" value="1" id="new_free{{$key}}" label="رایگان " wire:model.defer="free" />
                                            <x-admin.forms.checkbox with="2" value="1" id="new_can_homework{{$key}}" label="امکان بارگذاری تمرین "
                                                                    wire:model.defer="can_homework" />
                                            <x-admin.forms.checkbox with="2" value="1" id="new_show_api_video{{$key}}"
                                                                    label="نمایش ویدئو " wire:model.defer="show_api_video" />

                                            <x-admin.forms.checkbox with="2" value="1" id="new_allow_show_local_video{{$key}}"
                                                                    label="امکان نمایش ویدئو " wire:model.defer="allow_show_local_video" />
                                            <x-admin.forms.checkbox with="2" value="1" id="new_downloadable_local_video{{$key}}"
                                                                    label="امکان دانلود ویدئو " wire:model.defer="downloadable_local_video" />
                                            <x-admin.forms.text-area label="کد اشتراک گذاریapi " wire:model.defer="api_bucket" id="new_api_bucket{{$key}}" />
                                            <x-admin.forms.full-text-editor id="new_description{{$key}}" label="توضیحات*" wire:model.defer="description"/>

                                        </div>
                                        <button wire:click="saveEpisode('new','{{$key}}')" class="btn btn-sm btn-success">دخیره <i class="fa fa-save"></i></button>
                                    </fieldset>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="info">
                                            <th>عنوان درس</th>
                                            <th>امکان ارسال تمرین</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @isset($item['episodes'])
                                        @forelse($item['episodes'] as $key2 => $episode)
                                            <tr>
                                                <td>{{$episode['title']}}</td>
                                                <td>{{$episode['can_homework'] ? 'بله' : 'خیر'}}</td>
                                                <td>
                                                    @if(! isset($episode['has_transcript']) || ! $episode['has_transcript'])
                                                        <button wire:click="openEpisode('{{$key}}','{{$key2}}')" class="btn btn-default btn-xs"><span class="text-primary flaticon2-settings"></span>
                                                        </button>
                                                    @else
                                                        <span class="text-info">در حال برسی ...</span>
                                                    @endif
                                                    @if(! $transcript_view)
                                                        <button onclick="deleteEpisode('{{$key}}','{{$key2}}')" class="btn btn-default btn-xs"><span class="text-danger flaticon2-trash"></span>
                                                        </button>
                                                        @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td class="text-center" colspan="11">
                                                دیتایی جهت نمایش وجود ندارد
                                            </td>
                                        @endforelse
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
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

    </div>

    <x-admin.modal-page id="chapter" title="{{$title}}" wire:click="saveChapter('{{$chapter_key}}')">
        <x-admin.forms.validation-errors />
        <div class="row">
            <x-admin.forms.input with="4" type="text" id="title" label="عنوان *" wire:model.defer="title" />
            <x-admin.forms.dropdown with="4" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
            <x-admin.forms.input with="4" type="number" id="view" label="نمایش *" wire:model.defer="view" />
            <x-admin.forms.text-area label="توضیحات" wire:model.defer="description" id="description" />
        </div>
    </x-admin.modal-page>

    <x-admin.modal-page id="episode" title="{{$title}}" wire:click="saveEpisode('{{$epiosde_key}}')">
        <x-admin.forms.validation-errors />
        <div class="row">
            <x-admin.forms.input with="3" type="text" id="title" label="عنوان *" wire:model.defer="title" />
            <x-admin.forms.input with="3" type="url" id="link" label="لینک" wire:model.defer="link" />
            <x-admin.forms.input with="3" type="text" id="time" label="زمان *" wire:model.defer="time" />
            <x-admin.forms.input with="3" type="number" id="view" label="نمایش *" wire:model.defer="view" />
            <x-admin.forms.dropdown  id="homework_storage" :data="$data['storage']" label="  فضای ذخیره سازی تمرین"
                                    wire:model.defer="homework_storage" />
            <x-admin.forms.checkbox with="4" value="1" id="free" label="رایگان " wire:model.defer="free" />
            <x-admin.forms.checkbox with="4" value="1" id="can_homework" label="امکان بارگذاری تمرین "
                                    wire:model.defer="can_homework" />
            <x-admin.forms.checkbox with="4" value="1" id="show_api_video"
                                    label="نمایش ویدئو " wire:model.defer="show_api_video" />

            <x-admin.forms.full-text-editor id="description" label="توضیحات" wire:model.defer="description"/>
            <x-admin.forms.text-area label="کد اشتراک گذاریapi " wire:model.defer="api_bucket" id="api_bucket" />
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
                            <div class="row">
                                <x-admin.forms.checkbox with="6" value="1" id="allow_show_local_video"
                                                        label="امکان نمایش ویدئو " wire:model.defer="allow_show_local_video" />
                                <x-admin.forms.checkbox with="6" value="1" id="downloadable_local_video"
                                                        label="امکان دانلود ویدئو " wire:model.defer="downloadable_local_video" />
                            </div>
                        </td>

                    </tr>
                    </tbody>
                </table>
            </x-admin.form-section>
        </div>
    </x-admin.modal-page>
</div>

@push('scripts')
    <script>
        function deleteChapter(id) {
            Swal.fire({
                title: 'حذف فصل!',
                text: 'آیا از حذف فصل اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteChapter', id)
                }
            })
        }

        function deleteEpisode(chapter , episode) {
            Swal.fire({
                title: 'حذف درس!',
                text: 'آیا از حذف درس اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                @this.call('deleteEpisode', chapter , episode)
                }
            })
        }
    </script>
@endpush
