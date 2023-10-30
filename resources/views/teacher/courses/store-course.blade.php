<div>
    @section('title','دوره  ')
    <x-teacher.form-control deleteAble="true" deleteAble="{{false}}"  mode="{{$mode}}" title="{{$header}}" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-teacher.forms.validation-errors/>
        <div class="card-body">
            @if($mode == self::CREATE_MODE)
            <div class="row">
                <x-teacher.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-teacher.forms.dropdown with="6" id="level" :data="$data['level']" label="سطح دوره*" wire:model.defer="level"/>
                <x-teacher.forms.dropdown id="organ_id" with="6" :data="$data['organs']" label="اموزشگاه" wire:model.defer="organ_id"/>
                <x-teacher.forms.dropdown id="time_line" with="6" :data="$data['time_lines']" label="تایم لاین دوره" wire:model.defer="time_line"/>
            </div>
            <x-teacher.forms.basic-text-editor id="descriptions" label="توضیحات کامل" wire:model.defer="descriptions"/>
            <x-teacher.form-section label="فایل ها">
                <div class="">
                    <div wire:ignore.self>
                        @foreach($files as $key => $value)
                            <div class="input-box col-12">
                                <div class="form-group w-100">
                                    <div x-data="{ isUploading: false, progress: 0 }"
                                         x-on:livewire-upload-start="isUploading = true"
                                         x-on:livewire-upload-finish="isUploading = false"
                                         x-on:livewire-upload-error="isUploading = false"
                                         x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                        <input type="file" class="custom-file-input " wire:model="files.{{$key}}" id="image{{$key}}">
                                        <label class="custom-file-label"  for="image{{$key}}">
                                            {{ (!empty($files[$key] && $files[$key]->temporaryUrl())) ? str()->limit($files[$key]->temporaryUrl(),40) : 'انتخاب فایل' }}
                                        </label>
                                        <button type="button" wire:click="deleteFile('{{$key}}')" class="btn  btn-sm btn-outline-danger">حذف فایل</button>

                                        <div class="mt-2" x-show="isUploading">
                                            در حال اپلود فایل...
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>

                                        <br>
                                        <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                        <small class="text-info">jpg,jpeg,png,pdf,rar</small>

                                        <br>
                                        @error('file.*')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="input-box col-lg-12 py-2" wire:ignore>
                        <button type="button" wire:click="addFile" class="btn btn-sm btn-outline-primary">افزودن فایل جدید</button>
                    </div>
                </div>
            </x-teacher.form-section>
            @elseif($mode == self::UPDATE_MODE)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>عنوان دوره اموزشی</td>
                                <td>سطح دوره اموزشی</td>
                                <td>تایم لاین دوره</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$course->title}}</td>
                                <td>{{$course->level_label}}</td>
                                <td>{{$course->time_line_label}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <fieldset class="border p-4">
                            <legend>شرح درخواست</legend>
                            {!! $course->descriptions !!}
                        </fieldset>
                    </div>
                </div>
                <br>
                <x-teacher.form-section label="فایل ها">
                    @if(!empty($course->files))
                        @foreach($course->files as $item)
                            <strong class="d-block">
                                <button class="btn btn-sm btn-outline-success" wire:click="download('{{$item}}')">بارگیری فایل {{ $loop->iteration }}</button>
                            </strong>
                        @endforeach
                    @endif
                </x-teacher.form-section>
                <x-teacher.form-section label="پاسخ ها">
                    <x-chat-panel :chats="$course->chats" :file="$file" />
                </x-teacher.form-section>
            @endif
        </div>
    </div>
</div>
