<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> ارسال مدارک </h3>
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
                        <div class="input-box col-12">
                            <div class="form-group">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input type="file" class="custom-file-input" wire:model="file" id="image">
                                    <label class="custom-file-label"  for="image">انتخاب فایل</label>
                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png</small>
                                    <br>
                                    @error('file')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="input-box col-lg-12">
                            <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                 data-callback="reCaptchaCallback" wire:ignore></div>
                            @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>
                @else
                        <div class="input-box col-lg-6">
                            <label class="label-text">موضوع*</label>
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
                            <label class="label-text">الویت*</label>
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
                            <label class="label-text">متن اصلی*</label>
                            <x-admin.forms.basic-text-editor disabled with="12" id="content" label="" wire:model.defer="content"/>
                        </div>
                        <div class="input-box col-12">
                            <div class="form-group">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input disabled type="file" class="custom-file-input" wire:model.defer="file" id="image">
                                    <label class="custom-file-label"  for="image">انتخاب فایل</label>
                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png,rar,zip</small>
                                    <br>
                                </div>

                            </div>
                        </div>
                    @if(!empty($ticketFile))
                        <div class="form-group col-12">
                            <div class="form-control">
                                <small>
                                    <a target="_blank" href="{{ asset($ticketFile) }}">{{$ticketFile}}</a>
                                </small>
                            </div>
                        </div>
                    @endif
                        <div class="form-group col-12">
                            <x-admin.form-section label="تاریخپه گفتگو">
                                @forelse($child as $key =>  $item)
                                    <div class="media media-card  p-4 my-1 shadow-sm">
                                        <div class="media-body">
                                            <div class="d-flex flex-wrap pb-1">
                                                <h5>{{ $item->sender->name }}</h5>
                                            </div>
                                            <span class="d-block lh-18 py-2">{{ $item->date }}</span>
                                            <p class="pb-2">
                                                {!! $item->content !!}
                                            </p>
                                            @if(!empty($item->file))
                                                <div class="mt-2 p-2 bg-white">
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-danger mb-0 vazir font-13">فایل</p>
                                                        <p class="text-justify my-2 vazir font-13">
                                                            @foreach(explode(',',$item->file) as $value)
                                                                <a class="btn btn-link" href="{{ asset($value) }}">مشاهده</a>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="alert text-center alert-info">
                                        گفتگو ای وجود ندارد.
                                    </p>
                                @endforelse
                            </x-admin.form-section>
                        </div>

                        <div class="form-group col-12">
                            <x-admin.form-section label="ارسال پاسخ">
                                <x-admin.forms.basic-text-editor id="answer" label="" wire:model.defer="answer"/>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file my-4">
                                    <input type="file" class="custom-file-input" wire:model="file" id="image">
                                    <label class="custom-file-label"  for="image">انتخاب فایل</label>
                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود فایل...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                    <br>
                                    <small class="text-info">حداقل حجم مجاز : {{'2048'}} کیلوبایت</small>
                                    <small class="text-info">jpg,jpeg,png</small>

                                    <br>
                                    @error('file')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="input-box mt-4">
                                    <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                         data-callback="reCaptchaCallback" wire:ignore></div>
                                    @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                                </div>
                            </x-admin.form-section>
                        </div>
                @endif
                    <div class="input-box col-lg-12 py-2">
                        <button type="submit" class="btn theme-btn">ذخیره تغییرات</button>
                        <a href="{{ route('user.tickets') }}" class="btn btn-primary">بازگشت <i class="la la-long-arrow-left"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function reCaptchaCallback(response) {
        @this.set('recaptcha', response);
        }

        Livewire.on('resetReCaptcha', () => {
            grecaptcha.reset();
        });
    </script>
@endpush
