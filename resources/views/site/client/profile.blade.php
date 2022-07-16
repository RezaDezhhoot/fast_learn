<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i
            class="la la-bars mr-1"></i> منو
    </div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> پروفایل من </h3>
        </div>
        <ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
            <li class="nav-item">
                <a wire:click="$set('tab','profile')" class="nav-link {{ $tab == 'profile' ? 'active' : '' }}"
                   id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile"
                   aria-selected="false">
                    مشخصات
                </a>
            </li>
            <li class="nav-item">
                <a wire:click="$set('tab','wallet')" class="nav-link {{ $tab == 'wallet' ? 'active' : '' }}"
                   id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet"
                   aria-selected="false">
                    کیف پول
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent" wire:ignore.self>
            @if($tab == 'profile')
                <div class="tab-pane fade  {{ $tab == 'profile' ? 'show active' : '' }}" id="edit-profile"
                     role="tabpanel" aria-labelledby="edit-profile-tab" wire:ignore.self>
                    <div class="setting-body" wire:ignore.self>
                        <h3 class="fs-17 font-weight-semi-bold pb-4">ویرایش تصویر</h3>
                        <div class="media media-card align-items-center">
                            <div class="media-img media-img-lg mr-4 bg-gray">
                                @if(!is_null($file) && $file->temporaryUrl() !== null)
                                    <img class="mr-3" src="{{ $file->temporaryUrl() }}" alt="تصویر آواتار"/>
                                @elseif($user->image)
                                    <img class="mr-3" src="{{asset($user->image)}}" alt="تصویر آواتار">
                                @endif
                            </div>
                            <div class="media-body">
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     class="file-upload-wrap file-upload-wrap-2">
                                    <input type="file" wire:model="file" class="multi file-upload-input with-preview"/>
                                    <span class="file-upload-text"><i class="la la-photo mr-2"></i>انتخاب تصویر</span>
                                    <div class="mt-2" x-show="isUploading">
                                        در حال اپلود تصویر...
                                        <progress max="100" x-bind:value="progress"></progress>
                                    </div>
                                </div>
                                <!-- file-upload-wrap -->
                                <p class="fs-14">حداکثر اندازه فایل {{$max_file_size}} کیلوبایت، فایل های مناسب jpg و
                                    png.</p>
                                <br>
                                @error('file')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- end media -->
                        <form wire:submit.prevent="store()" class="row pt-40px">
                            <div class="input-box col-lg-6">
                                <label class="label-text">نام کامل</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="text"
                                           wire:model.defer="name"/>
                                    <span class="la la-user input-icon"></span>
                                    @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-box col-lg-6">
                                <label class="label-text">ایمیل </label>
                                <div class="form-group">
                                    <input disabled class="form-control form--control" type="text" name="text"
                                           wire:model.defer="email"/>
                                    <span class="la la-envelope input-icon"></span>
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-box col-lg-6">
                                <label class="label-text">رمز عبور جدید</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" wire:model.defer="password"
                                           name="text" placeholder="در صورت خالی بودن تغییری ایجاد نمی شود"/>
                                    <span class="la la-lock input-icon"></span>
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="input-box col-lg-6">
                                <label class="label-text">شماره ملی </label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="text"
                                           wire:model.defer="code_id"/>
                                    <span class="la la-id-card input-icon"></span>
                                    @error('code_id')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- end input-box -->
                            <div class="input-box col-lg-6">
                                <label class="label-text">نام پدر</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="text"
                                           wire:model.defer="father_name"/>
                                    <span class="la la-user input-icon"></span>
                                    @error('father_name')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box col-lg-6  position-relative" id="date-pickers">
                                <label class="label-text">تاریخ تولد</label>
                                <div class="form-group">
                                    <input id="birthday" class="form-control form--control" wire:model.defer="birthday"
                                           x-data
                                           x-init="$('#birthday').persianDatepicker({
                                   formatDate: 'YYYY-MM-DD',
                                   onSelect: function () {
                                            $dispatch('input', $('#birthday').val())
                                        },

                                   });">
                                    <span class="la la-calendar-day input-icon"></span>
                                    @error('birthday')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box col-lg-6">
                                <label class="label-text">استان</label>
                                <div class="form-group">
                                    <select class="form-control form--control" name="province" wire:model="province"
                                            id="province">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($data['province'] as $key => $item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span class="la la-city input-icon"></span>
                                    @error('province')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box col-lg-6">
                                <label class="label-text">شهر</label>
                                <div class="form-group">
                                    <select class="form-control form--control" name="city" wire:model.defer="city"
                                            id="city">
                                        <option value="">انتخاب کنید</option>
                                        @foreach($data['city'] as $key => $item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span class="la la-city input-icon"></span>
                                    @error('city')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box col-lg-12 py-2">
                                <button type="submit" class="btn theme-btn">ذخیره تغییرات</button>
                            </div>
                            <!-- end input-box -->
                        </form>
                    </div>

                    <div class="setting-body pt-20px" wire:ignore.self>
                        <h3 class="fs-17 font-weight-semi-bold pb-4">اطلاعات مدرس</h3>
                        @role('teacher')
                        <form wire:submit.prevent="storeTeacher()" class="row">
                            <div class="input-box col-12">
                                <label class="label-text">عنوان</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="text"
                                           wire:model.defer="teacher_title"/>
                                    <span class="la la-user input-icon"></span>
                                    @error('teacher_title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-box col-12">
                                <label class="label-text">متن</label>
                                <x-admin.forms.basic-text-editor with="12" id="content" label="" wire:model.defer="teacher_content"/>
                            </div>
                            <div class="input-box col-lg-12 py-2">
                                <button type="submit" class="btn theme-btn">ذخیره تغییرات</button>
                            </div>
                        </form>
                        @endif
                    </div>
                    <!-- end setting-body -->
                </div>
            @else
                <div class="tab-pane fade {{ $tab == 'wallet' ? 'show active' : '' }}" id="wallet" role="tabpanel"
                     aria-labelledby="wallet-tab" wire:ignore.self>
                    <div class="setting-body" wire:ignore.self>
                        <h3 class="fs-17 font-weight-semi-bold pb-4">کیف پول</h3>
                        @if(!is_null($message))
                            <p class="alert alert-{{$isSuccessful ? 'success' : 'danger'}}">{{$message}}</p>
                        @endif
                        <div class="danger-zone">
                            <p class="pt-1 pb-4"><span
                                    class="text-primary">موجودی کیف پول:</span> {{ number_format(auth()->user()->balance) }}
                                تومان</p>
                            <div class="row">
                                <div class="input-box col-12 ">
                                    <label class="label-text">افزایش اعتبار : </label>
                                    <div class="form-group">
                                        <input class="form-control form--control" placeholder="مبلغ" type="text"
                                               name="text" wire:model.defer="price"/>
                                        <span class="la la-money input-icon"></span>
                                        @error('price')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-box col-12">
                                    <label class="label-text">روش پرداخت را انتخاب کنید </label>
                                    <div class="payment-option-wrap">
                                        <div class="row">
                                            @foreach($gateways as $key => $item)
                                                <div class="col-12 col-md-4">
                                                    <div class="p-2">
                                                        <img src="{{ asset($item['logo']) }}" alt="">
                                                        <input id="{{$key}}" name="gateway" type="radio"
                                                               wire:model.defer="gateway" value="{{$key}}"/>
                                                        <label for="{{$key}}">
                                                            {{$item['title']}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('gateway')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="col-12 py-3">
                                    <button wire:click="payment" class="btn theme-btn">پرداخت <i
                                            class="la la-arrow-left icon ml-1"></i></button>
                                    <br>
                                    <p wire:loading class="text-secondary text-right">
                                        در حال پردازش ...
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end setting-body -->
                </div>
            @endif
            <!-- end tab-pane -->
        </div>
        <!-- end row -->
    </div>
</div>
