<div wire:init="loadHomework">
    <div class="d-flex justify-content-between">
        <div class="d-flex align-items-center">
            <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">ارسال تمرین</h5>
        </div>
        <div>
            @if(!is_null($homework_show) && empty($homework_show->result))
                <button class="btn btn-sm btn-outline-danger" onclick="delete_homework()"><i
                        class="la la-trash"></i> حذف این تمرین</button>
            @endif
        </div>
    </div>
    @if($show_homework_form)
        <form wire:submit.prevent="submit_homework()">
            <div class="row">
                @auth
                    <div class="input-box col-12">
                        <div class="form-group">
                            <div x-data="{ isUploading: false, progress: 0 }"
                                 x-on:livewire-upload-start="isUploading = true"
                                 x-on:livewire-upload-finish="isUploading = false"
                                 x-on:livewire-upload-error="isUploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress"
                                 class="custom-file my-4">
                                <input {{ !is_null($homework_show) ? 'disabled' : '' }} type="file"
                                       class="custom-file-input" wire:model="homework_file" id="homework_file">
                                <label class="custom-file-label" for="homework_file">انتخاب فایل</label>
                                <div class="mt-2" x-show="isUploading">
                                    در حال اپلود فایل...
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                <small class="text-info">حداقل حجم مجاز : 2 مگابایت</small>
                                <small class="text-info">jpg,jpeg,png,pdf,zip,rar</small>
                                @if(!is_null($homework_show) && !is_null($homework_show->file))
                                    <small class="alert d-block p-1 alert-success">فایل ارسال شده است</small>
                                @endif
                                @error('homework_file')
                                <small class="text-danger d-block">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="input-box col-lg-12">
                        <label class="label-text">توضیحات</label>
                        <div class="form-group">
                                <textarea {{ !is_null($homework_show) ? 'disabled' : '' }}
                                          wire:model.defer="homework_description" class="form-control form--control pl-3"
                                          name="homework_description" placeholder="توضیحات" rows="5"></textarea>
                        </div>
                        @error('homework_description')
                        <span class="invalid-feedback d-block">{{$message}}</span>
                        @enderror
                    </div>
                    <div
                        class="input-box col-lg-12 text-right overflow-hidden mb-3">
                        <div class="g-recaptcha d-inline-block"
                             data-sitekey="{{ config('services.recaptcha.site_key') }}"
                             data-callback="homeworkReCaptchaCallback" wire:ignore></div>
                        @error('homework_recaptcha')<span class="invalid-feedback d-block">{{ $message
                                }}</span>@enderror
                    </div>
                    <div class="btn-box col-lg-12 {{ !is_null($homework_show) ? 'd-none' : '' }}">
                        <button {{ !is_null($homework_show) ? 'disabled' : '' }} class="btn theme-btn"
                                type="submit">ارسال تمرین</button>
                    </div>
                    @if(!is_null($homework_show) && !is_null($homework_show->result))
                        <div class="col-12">
                            <h6>نتیجه :</h6>
                            <small>
                                @for($i=1; $i<=5; $i++) @if($i <=$homework_show->score)
                                    <span class="la la-star"></span>
                                @else
                                    <span class="la la-star-o"></span>
                                @endif
                                @endfor
                            </small>
                            <p class="mr-1">
                                {!! $homework_show->result !!}
                            </p>
                        </div>
                    @endif
                @else
                    <p class="text-info">
                        برای ارسال تمرین ابتدا ثبت نام کنید
                    </p>
                @endif
            </div>
        </form>
    @else
        <p class="alert alert-danger">شما به این بخش دسترسی ندارید.</p>
    @endif
</div>
@push('scripts')
    <script>
        function delete_homework() {
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
                @this.call('delete_homework')
                }
            })
        }
        function homeworkReCaptchaCallback(response) {
        @this.set('homework_recaptcha', response);
        }

        function reCaptchaCallback(response) {
        @this.set('recaptcha', response);
        }

        Livewire.on('resetReCaptcha', () => {
            grecaptcha.reset();
        });

        Livewire.on('loadRecaptcha', () => {
            const script = document.createElement('script');

            script.setAttribute('src', 'https://www.google.com/recaptcha/api.js');

            const start = document.createElement('script');


            document.body.appendChild(script);
            document.body.appendChild(start);
        });
    </script>
@endpush
