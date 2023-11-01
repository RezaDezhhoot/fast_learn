<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> پشتیبانی </h3>
        </div>
        <div class="dashboard-cards mb-5">
            <form wire:submit.prevent="store()">
                <div class="row">
                @if($mode == self::CREATE_MODE)
                        <div class="input-box col-lg-6">
                            <label class="label-text">موضوع*</label>
                            <div class="form-group">
                                <select class="form-control form--control" name="subject" wire:model="subject" id="subject">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($data['subject'] as $key => $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <span class="la la-pen-nib input-icon"></span>
                                @error('subject')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-lg-6">
                            <label class="label-text">اولویت*</label>
                            <div class="form-group">
                                <select class="form-control form--control" name="priority" wire:model="priority" id="priority">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($data['priority'] as $key => $item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <span class="la la-level-up input-icon"></span>
                                @error('priority')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-12">
                            <label class="label-text">متن اصلی*</label>
                            <x-admin.forms.basic-text-editor with="12" id="content" label="" wire:model.defer="content"/>
                        </div>
                        @foreach($main_file as $key => $value)
                        <div class="input-box col-12">
                            <div class="form-group">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input type="file" class="custom-file-input" wire:model="main_file.{{$key}}" id="image{{$key}}">
                                    <label class="custom-file-label"  for="image{{$key}}">
                                        {{ (!empty($main_file[$key] && $main_file[$key]->temporaryUrl())) ? str()->limit($main_file[$key]->temporaryUrl(),40) : 'انتخاب فایل' }}
                                    </label>
                                    <button type="button" wire:click="deleteFile('{{$key}}')" class="btn btn-sm btn-outline-danger">حذف فایل</button>

                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>

                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png,pdf</small>

                                    <br>
                                    @error('file.*')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="input-box col-lg-12 py-2" wire:ignore>
                            <button type="button" wire:click="addFile" class="btn btn-sm btn-outline-primary">افزودن فایل جدید</button>
                        </div>
                        <div class="input-box col-lg-12 py-2">
                            <button type="submit" class="btn theme-btn">ذخیره تغییرات</button>
                        </div>

                @else
                        <div class="input-box col-lg-6">
                            <label class="label-text">موضوع</label>
                            <div class="form-group">
                                <select disabled class="form-control form--control" name="subject" wire:model="subject" id="subject">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($data['subject'] as $key => $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <span class="la la-pen-nib input-icon"></span>
                                @error('subject')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-lg-6">
                            <label class="label-text">الویت</label>
                            <div class="form-group">
                                <select disabled class="form-control form--control" name="priority" wire:model="priority" id="priority">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($data['priority'] as $key => $item)
                                        <option value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <span class="la la-level-up input-icon"></span>
                                @error('priority')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-12">
                            <label class="label-text">متن اصلی</label>
                            <div class="media media-card  p-4 my-1 shadow-sm">
                                {!! $content !!}
                            </div>
                        </div>

                    @if(!empty($ticketFile))
                        <div class="form-group col-12">
                            <label class="label-text">فایل ها :</label>
                            <div class="">
                                @foreach($ticketFile as $item)
                                    <small class="d-block">
                                        <a target="_blank" href="{{ asset($item) }}">مشاهده</a>
                                    </small>
                                @endforeach
                            </div>
                        </div>
                    @endif
                        <div class="form-group col-12">
                            <x-admin.form-section label="تاریخپه گفتگو">
                                <x-site.chat :multiple="false" :chats="$child"  file_label="file" :file="$file" sender="sender_id" message="content" />
                            </x-admin.form-section>
                        </div>
                @endif

                </div>
            </form>
        </div>
    </div>
</div>
