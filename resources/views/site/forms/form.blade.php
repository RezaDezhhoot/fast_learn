<div wire:init="loadMore">
    <section class="register-area section--padding dot-bg overflow-hidden">
        <div class="container">
            <div class="register-heading-content-wrap text-center">
                <div class="section-heading">
                    <h2 class="section__title">{{$model->name}}</h2>
                </div>
                <!-- end section-heading -->
            </div>
            <div class="row pt-50px">
                <div class="col-lg-10 mx-auto">
                    <div class="card card-item">
                        <div class="card-body">
                            @if(!$result)
                            <form method="post" wire:submit.prevent="store"  class="row">
                                @foreach($form as $key => $item)
                                    @if($item['type'] == 'text')
                                        @if(FormBuilder::isVisible($form, $item))
                                            <div class="input-box col-12 my-2 col-lg-{{$item['width']}}">
                                                <label for="{{$key}}" class="label-text"> {!! $item['label'] !!}</label>
                                                <input id="{{$key}}" type="text" name="{{$item['name']}}" class="form-control form--control p-1" placeholder="{{$item['placeholder']}}"
                                                       wire:model.defer="form.{{$key}}.value">
                                                @error('form.'.$key.'.error')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    @endif

                                    @if($item['type'] == 'textArea')
                                        @if(FormBuilder::isVisible($form, $item))
                                                <div class="input-box col-12 my-2 col-lg-{{$item['width']}}">
                                                <label for="{{$key}}" class="label-text">{!! $item['label'] !!}</label>
                                                <textarea id="{{$key}}" name="{{$item['name']}}" class="form-control form--control p-1"
                                                          placeholder="{{$item['placeholder']}}" rows="4" wire:model.defer="form.{{$key}}.value"></textarea>
                                                @error('form.'.$key.'.error')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    @endif
                                    @if($item['type'] == 'select')
                                        @if(FormBuilder::isVisible($form, $item))
                                                <div class="input-box col-12 my-2 col-lg-{{$item['width']}}">
                                                <label for="{{$key}}" class="label-text">{!! $item['label'] !!}</label>
                                                <select id="{{$key}}" name="{{$item['name']}}" class="form-control form--control p-1" wire:model="form.{{$key}}.value">
                                                    <option value="">انتخاب کنید...</option>
                                                    @foreach($item['options'] as $option)
                                                        <option value="{{$option['value']}}">{{$option['value']}}</option>
                                                    @endforeach
                                                </select>
                                                @error('form.'.$key.'.error')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    @endif
                                    @if($item['type'] == 'customRadio')
                                        @if(FormBuilder::isVisible($form, $item))
                                                <div class="input-box col-12 col-lg-{{$item['width']}}">
                                                    <p>{!! $item['label'] !!}</p>
                                                    <div class="form-check form-check-inline">
                                                        @foreach($item['options'] as $keyRadio => $radio)
                                                            <label class="form-check-label mx-2">
                                                                <input type="radio" name="{{$item['name']}}" class="form-check-input" value="{{$radio['value']}}"
                                                                       wire:model="form.{{$key}}.value">{{$radio['value']}}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                @error('form.'.$key.'.error')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    @endif
                                    @if($item['type'] == 'paragraph')
                                        @if(FormBuilder::isVisible($form, $item))
                                                <div class="input-box col-12 col-lg-{{$item['width']}}">
                                                <div class="flex items-center gap-4 flex-wrap">
                                                    {!! $item['label'] !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                        @if($item['type'] == 'file')
                                            @if(FormBuilder::isVisible($form, $item))
                                                <div class="input-box col-12 my-2 col-lg-{{$item['width']}}">
                                                    <label class="label-text">{!! $item['label'] !!}</label>
                                                    <div class="input-box col-12 p-0 m-0">
                                                        <div class="form-group w-100">
                                                            <div x-data="{ isUploading: false, progress: 0 }"
                                                                 x-on:livewire-upload-start="isUploading = true"
                                                                 x-on:livewire-upload-finish="isUploading = false"
                                                                 x-on:livewire-upload-error="isUploading = false"
                                                                 x-on:livewire-upload-progress="progress = $event.detail.progress" class="custom-file">
                                                                <input type="file" class="custom-file-input" wire:model.defer="form.{{$key}}.value" id="{{$key}}">
                                                                <label class="custom-file-label"  for="{{$key}}">
                                                                    {{ (!empty($form[$key]['value'] && $form[$key]['value']->temporaryUrl())) ? str()->limit($form[$key]['value']->temporaryUrl(),40) : 'انتخاب فایل' }}
                                                                </label>

                                                                <div class="mt-2" x-show="isUploading">
                                                                    در حال اپلود فایل...
                                                                    <progress max="100" x-bind:value="progress"></progress>
                                                                </div>

                                                                <br>
                                                                <small class="text-info">حداقل حجم مجاز : {{$storageConfig['max_file_size']}} کیلوبایت</small>
                                                                <small class="text-info">{{implode(',',$storageConfig['allow_file_types'])}}</small>

                                                                <br>
                                                                @error('form.'.$key.'.value')
                                                                <small class="text-danger">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                @endforeach
                                    <div class="input-box col-lg-12 text-right overflow-hidden mb-3">
                                        <div class="g-recaptcha d-inline-block"
                                             data-sitekey="{{ config('services.recaptcha.site_key') }}"
                                             data-callback="reCaptchaCallback" wire:ignore></div>
                                        @error('recaptcha')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="btn-box col-lg-12 my-3">
                                        <button class="btn theme-btn" type="submit">ارسال <i class="la la-arrow-left icon ml-1"></i></button>
                                    </div>
                            </form>
                            @else
                                <div class="text-center mb-3">
                                    <h5 class="mt-3">اطلاعات با موفقیت ذخیره شدند</h5>
                                    <div class="btn-box pt-30px">
                                        <a href="{{ route('home') }}" class="btn theme-btn"><i class="la la-reply mr-1"></i> بازگشت به خانه</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')

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

        Livewire.on('loadRecaptcha', () => {
            const script = document.createElement('script');

            script.setAttribute('src', 'https://www.google.com/recaptcha/api.js');

            const start = document.createElement('script');


            document.body.appendChild(script);
            document.body.appendChild(start);
        });
    </script>
@endpush
