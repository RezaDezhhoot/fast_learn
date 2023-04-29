    <div wire:init="loadMore">
    <x-site.breadcrumbs :data="$page_address" title="ارتباط با ما" />

        <section class="contact-area  position-relative">
            <span class="ring-shape ring-shape-1"></span>
            <span class="ring-shape ring-shape-2"></span>
            <span class="ring-shape ring-shape-3"></span>
            <span class="ring-shape ring-shape-4"></span>
            <span class="ring-shape ring-shape-5"></span>
            <span class="ring-shape ring-shape-6"></span>
            <span class="ring-shape ring-shape-7"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 responsive-column-half">
                        <div class="info-box">
                            <div class="info-overlay"></div>
                            <div class="icon-element mx-auto shadow-sm">
                                <svg class="svg-icon-color-2" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M469.333,64H42.667C19.135,64,0,83.135,0,106.667v298.667C0,428.865,19.135,448,42.667,448h426.667
                                        C492.865,448,512,428.865,512,405.333V106.667C512,83.135,492.865,64,469.333,64z M42.667,85.333h426.667
                                        c1.572,0,2.957,0.573,4.432,0.897c-36.939,33.807-159.423,145.859-202.286,184.478c-3.354,3.021-8.76,6.625-15.479,6.625
                                        s-12.125-3.604-15.49-6.635C197.652,232.085,75.161,120.027,38.228,86.232C39.706,85.908,41.094,85.333,42.667,85.333z
                                         M21.333,405.333V106.667c0-2.09,0.63-3.986,1.194-5.896c28.272,25.876,113.736,104.06,169.152,154.453
                                        C136.443,302.671,50.957,383.719,22.46,410.893C21.957,409.079,21.333,407.305,21.333,405.333z M469.333,426.667H42.667
                                        c-1.704,0-3.219-0.594-4.81-0.974c29.447-28.072,115.477-109.586,169.742-156.009c7.074,6.417,13.536,12.268,18.63,16.858
                                        c8.792,7.938,19.083,12.125,29.771,12.125s20.979-4.188,29.76-12.115c5.096-4.592,11.563-10.448,18.641-16.868
                                        c54.268,46.418,140.286,127.926,169.742,156.009C472.552,426.073,471.039,426.667,469.333,426.667z M490.667,405.333
                                        c0,1.971-0.624,3.746-1.126,5.56c-28.508-27.188-113.984-108.227-169.219-155.668c55.418-50.393,140.869-128.57,169.151-154.456
                                        c0.564,1.91,1.194,3.807,1.194,5.897V405.333z"
                                            ></path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="info__title">به ما ایمیل بزنید</h3>
                            <p class="info__text">{{ $email }}</p>
                        </div>
                        <!-- end info-box -->
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-6 responsive-column-half">
                        <div class="info-box">
                            <div class="info-overlay"></div>
                           <div class="d-flex justify-content-center">
                               <div class="icon-element mx-1 d-flex align-items-center justify-content-center shadow-sm">
                                   <i class="la la-whatsapp text-success"></i>
                               </div>
                               <div class="icon-element mx-1 d-flex align-items-center justify-content-center shadow-sm">
                                   <i class="la la-telegram text-primary"></i>
                               </div>
                           </div>
                            <h3 class="info__title">به ما پیام دهید </h3>
                            <p class="info__text">{{ $tel }}</p>
                        </div>
                        <!-- end info-box -->
                    </div>
                    <!-- end col-lg-3 -->
                </div>
                <!-- end row -->
                <div class="row pt-30px">
                    <div class=" col-12">
                        <style>
                            iframe {
                                width: 100%;
                                height: 400px;
                            }
                        </style>
                        <div class="map-container" wire:ignore>
                            {!! $google !!}
                        </div>
                        <!-- end map-container -->
                    </div>
                    <div class="my-4 col-lg-5 mt-5">
                        <div class="contact-content pb-5">
                            <div class="section-heading">
                                {!! $contact !!}
                            </div>
                            <!-- end section-heading -->
                            <ul class="social-icons social-icons-styled social--icons-styled pt-30px">
                                    @if(!empty($telegram))
                                    <li>
                                        <a href="{{ $telegram }}"><i class="la la-telegram la-lg"></i></a>
                                    </li>
                                   @endif
                                        @if(!empty($whatsapp))
                                            <li>
                                                <a href="{{ $whatsapp }}"><i class="la la-whatsapp la-lg"></i></a>
                                            </li>
                                        @endif
                                    @if(!empty($linkedin))
                                    <li>
                                        <a href="{{ $linkedin }}"><i class="la la-linkedin la-lg"></i></a>
                                    </li>
                                    @endif
                                    @if(!empty($instagram))
                                    <li>
                                        <a href="{{ $instagram }}"><i class="la la-instagram la-lg"></i></a>
                                    </li>
                                    @endif
                                        @if(!empty($aparat))
                                            <li>
                                                <a href="{{ $aparat }}"><i class="la la-video la-lg"></i></a>
                                            </li>
                                        @endif
                            </ul>
                        </div>
                    </div>
                    <div class="my-4 col-lg-7 mt-5">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="fs-24 font-weight-semi-bold pb-4">از اینجا پیام بگذارید</h3>
                                <form wire:submit.prevent="contact" class="contact-form">
                                    <div class="input-box">
                                        <label class="label-text">اسم کامل شما</label>
                                        <div class="form-group">
                                            <input wire:model.defer="full_name" id="name" class="form-control form--control" type="text" name="name" placeholder="اسم شما" />
                                            <span class="la la-user input-icon"></span>
                                        </div>
                                        @error('full_name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">آدرس ایمیل</label>
                                        <div class="form-group">
                                            <input id="email" wire:model.defer="email" class="form-control form--control" type="email" name="email" placeholder="آدرس ایمیل" />
                                            <span class="la la-envelope input-icon"></span>
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="input-box">
                                        <label class="label-text">شماره همراه</label>
                                        <div class="form-group">
                                            <input id="email" wire:model.defer="phone" class="form-control form--control" type="text" name="phone" placeholder="شماره همراه" />
                                            <span class="la la-phone input-icon"></span>
                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <!-- end input-box -->
                                    <div class="input-box">
                                        <label class="label-text">پیام</label>
                                        <div class="form-group">
                                            <textarea wire:model.defer="body" id="message" class="form-control form--control pl-4" name="message" rows="5" placeholder="پیام"></textarea>
                                        </div>
                                        @error('body')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="input-box col-lg-12 text-right overflow-hidden mb-3 max-h-100px" style="max-height: 100px">
                                        <div class="g-recaptcha d-inline-block"
                                             data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                             data-callback="reCaptchaCallback" wire:ignore></div>
                                        @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                                    </div>
                                    <!-- end input-box -->
                                    <div class="btn-box">
                                        <button  class="btn theme-btn" type="submit">ارسال پیام</button>
                                    </div>
                                    <!-- end btn-box -->
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>

                    <!-- end col-lg-12 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
</div>
    @push('scripts')
        <script>
            Livewire.on('loadRecaptcha', () => {
                const script = document.createElement('script');

                script.setAttribute('src', 'https://www.google.com/recaptcha/api.js?hl=fa');

                const start = document.createElement('script');


                document.body.appendChild(script);
                document.body.appendChild(start);
            });
            function reCaptchaCallback(response) {
                @this.set('recaptcha', response);
            }

            Livewire.on('resetReCaptcha', () => {
                grecaptcha.reset();
            });
        </script>
    @endpush
