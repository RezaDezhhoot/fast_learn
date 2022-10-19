<div>
    @section('title','دوره  ')
    <x-teacher.form-control deleteAble="true"  mode="{{$mode}}" title="شروع دوره جدید" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-teacher.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
                <x-teacher.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-teacher.forms.dropdown with="6" id="level" :data="$data['level']" label="سطح دوره*" wire:model.defer="level"/>
            </div>
            <x-teacher.forms.basic-text-editor id="descriptions" label="توضیحات کامل" wire:model.defer="descriptions"/>
            <x-admin.form-section label="فایل ها">
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
            </x-admin.form-section>

        </div>
    </div>
</div>
