<section class="contact-area mt-4 position-relative"  wire:init="checkSession"  >
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card card-item">
                    <div class="card-body">
                        @if($action == self::FORGET_MODE)
                            <h3 class="card-title text-center fs-24 lh-35 pb-4">فراموشی رمز</h3>
                            <div class="section-block"></div>
                            <form  wire:submit.prevent="forget" class="pt-4">
                            <div class="input-box">
                                <label class="label-text">شماره همراه</label>
                                <div class="form-group">
                                    <input wire:model.defer="phone" class="form-control form--control" type="text" name="name" placeholder="شماره همراه" />
                                    <span class="la la-user input-icon"></span>
                                    @error('phone')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box mt-4" id="recaptcha">
                                <div class="g-recaptcha d-inline-block" data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                     data-callback="reCaptchaCallback" wire:ignore></div>
                                @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                            <div class="btn-box">
                                <button class="btn theme-btn mt-3" type="submit">ارسال<i class="la la-arrow-left icon ml-1"></i></button>
                            </div>
                        </form>
                        @elseif($action == self::VERIFY_MODE)
                            <h3 class="card-title text-center fs-24 lh-35 pb-4">تایید شماره همراه </h3>
                            <div class="section-block"></div>
                            <form  wire:submit.prevent="verify" class="pt-4">

                                <div class="input-box">
                                    <label class="label-text">کد تایید</label>
                                    <div class="form-group">
                                        <input wire:model.defer="code" class="form-control form--control" type="text" name="code" placeholder="کد تایید" />
                                        <span class="la la-user input-icon"></span>
                                        @error('code')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="btn-box">
                                    @if(!$sent)
                                        <small wire:click="sendVerificationCode" class=" mt-2 d-block cursor-pointers font-12 vazir">ارسال مجدد رمز یکبار مصرف</small>
                                    @else
                                        <div>
                                            <small class="px-1 text-info mt-2 font-12 vazir" wire:ignore.self>
                                                زمان باقی مانده تا ارسال مجدد:
                                                <span id="clock"></span>
                                            </small>
                                        </div>
                                    @endif
                                    <button class="btn theme-btn mt-3" type="submit">ارسال<i class="la la-arrow-left icon ml-1"></i></button>
                                </div>
                            </form>
                        @elseif($action == self::RESET_MODE)
                            <h3 class="card-title text-center fs-24 lh-35 pb-4">ویرایش رمز</h3>
                            <div class="section-block"></div>
                            <form  wire:submit.prevent="resetPassword" class="pt-4">
                                <div class="input-box">
                                    <label class="label-text">
                                       رمز عبور جدید
                                    </label>
                                    <div class="input-group">
                                        <span class="la la-lock input-icon"></span>
                                        <input class="form-control form--control password-field" wire:model.defer="password"  type="password"    placeholder="رمز عبور" />
                                    </div>
                                    @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="input-box">
                                    <label class="label-text">
                                        رمز عبور جدید
                                    </label>
                                    <div class="input-group">
                                        <span class="la la-lock input-icon"></span>
                                        <input class="form-control form--control password-field" name="password_confirmation" wire:model.defer="password_confirmation"  type="password"    placeholder=" تایید رمز عبور" />
                                    </div>
                                    @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="btn-box">
                                    <button class="btn theme-btn mt-3" type="submit">ارسال<i class="la la-arrow-left icon ml-1"></i></button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        Livewire.on('timer', function (data) {
            $('#clock').countdown(data.data)
                .on('update.countdown', function(event) {
                    var format = '%M:%S';
                    if(event.offset.totalDays > 0) {
                        format = '%-d روز ' + format;
                    }
                    if(event.offset.weeks > 0) {
                        format = '%-w هفته ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function(event) {
                    $(this).html('اتمام زمان!')
                        .parent().addClass('disabled');
                @this.call('canSendAgain')
                });
        })
        Livewire.on('removeRecaptcha', function (data) {
            $('#recaptcha').remove();
        })

    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function reCaptchaCallback(response) {
        @this.set('recaptcha', response);
        }

        function back_to_episode(id)
        {
            $('html, body').animate({
                scrollTop: $(`#episode${id}`).offset().top
            }, 1000);
        }

        Livewire.on('resetReCaptcha', () => {
            grecaptcha.reset();
        });
    </script>
@endpush
