<div>
    @section('title','ارگان')
    <x-organ.form-control  title="ارگان" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-organ.forms.validation-errors />
        <div class="card-body">
            <x-organ.form-section label="اطلاعات ثبت شده">
                <div class="row">
                    <x-organ.forms.input  type="text" id="address" label="ادرس" wire:model.defer="address"/>
                    <x-organ.forms.input with="6"  type="email" id="email" label="ایمیل" wire:model.defer="email"/>
                    <x-organ.forms.input with="6" type="text" id="phone1" label="شماره1" wire:model.defer="phone1"/>
                    <x-organ.forms.input with="6" type="text" id="phone2" label="شماره2" wire:model.defer="phone2"/>
                    <x-organ.forms.dropdown with="6" id="province" :data="$data['province']" label="استان" wire:model="province"/>
                    <x-organ.forms.dropdown with="6" id="city" :data="$data['city']" label="شهر" wire:model.defer="city"/>
                    <x-organ.forms.input with="6" type="text" id="web_site" label="وبسایت" wire:model.defer="web_site"/>
                    <div wire:ignore.self>
                        <div class="input-box col-12">
                            <div class="form-group w-100">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input type="file" class="custom-file-input" wire:model="new_logo" id="logo">
                                    <label class="custom-file-label"  for="logo">
                                        {{ is_object($new_logo) ? str()->limit($new_logo->temporaryUrl(),40) : 'انتخاب لوگو' }}
                                    </label>

                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>

                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png,pdf,rar</small>

                                    <br>
                                    @error('new_logo')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    @if(is_object($new_logo) && $new_logo->temporaryUrl() !== null)
                                        <img class="mr-3 max-h-100px max-w-100px" src="{{ $new_logo->temporaryUrl() }}" alt="تصویر لوگو"/>
                                    @elseif($logo)
                                        <img class="mr-3 max-h-100px max-w-100px" src="{{asset($logo)}}" alt="تصویر لوگو">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self>
                        <div class="input-box col-12">
                            <div class="form-group w-100">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input type="file" class="custom-file-input" wire:model="new_image" id="image">
                                    <label class="custom-file-label"  for="logo">
                                        {{ is_object($new_image) ? str()->limit($new_image->temporaryUrl(),40) : 'انتخاب فایل' }}
                                    </label>

                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>

                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png,pdf,rar</small>

                                    <br>
                                    @error('new_image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    @if(is_object($new_image) && $new_image->temporaryUrl() !== null)
                                        <img class="mr-3 max-h-100px max-w-100px" src="{{ $new_image->temporaryUrl() }}" alt="تصویر "/>
                                    @elseif($image)
                                        <img class="mr-3 max-h-100px max-w-100px" src="{{asset($image)}}" alt="تصویر ">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-organ.forms.full-text-editor id="description" label="توضیحات" wire:model.defer="description"/>
                </div>
            </x-organ.form-section>
        </div>
    </div>
</div>
