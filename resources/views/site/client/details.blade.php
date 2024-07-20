<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i
            class="la la-bars mr-1"></i> منو
    </div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> تکمیل پروفایل </h3>
        </div>
        <div class="dashboard-cards mb-5">
            <form wire:submit.prevent="store()">
                <div class="row">
                    <div class="input-box col-lg-6">
                        <label class="label-text">شماره ملی *</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="text"
                                   wire:model.defer="code_id"/>
                            <span class="la la-id-card input-icon"></span>
                            @error('code_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-box col-lg-6  position-relative" id="date-pickers">
                        <label class="label-text">تاریخ تولد*</label>
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
                        <label class="label-text">مقطع تحصیلی*</label>
                        <div class="form-group">
                            <select class="form-control form--control" name="grade" wire:model="grade" id="grade">
                                <option value="">انتخاب کنید</option>
                                @foreach($data['grade'] as $key => $item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span class="la la-level-up input-icon"></span>
                            @error('grade')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-box col-lg-6">
                        <label class="label-text">کد معرف </label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="identification_code"
                                   wire:model.defer="identification_code"/>
                            <span class="la la-id-card input-icon"></span>
                            @error('identification_code')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    @if($grade == \App\Enums\Grades::COLLEGIAN || $grade == \App\Enums\Grades::STUDENT)
                        <div class="input-box col-lg-12">
                            <label class="label-text">{{ $grade == \App\Enums\Grades::COLLEGIAN ? 'نام دانشگاه' : "نام مدرسه" }} *</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="school"
                                       wire:model.defer="school"/>
                                <span class="la la-id-card input-icon"></span>
                                @error('school')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="input-box col-lg-12">
                        <label class="label-text">منطقه تحصیلی*</label>
                        <div class="form-group">
                            <input class="form-control form--control" type="text" name="study_area"
                                   wire:model.defer="study_area"/>
                            <span class="la la-id-card input-icon"></span>
                            @error('study_area')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-box col-lg-12 py-2">
                        <button type="submit" class="btn btn-outline-success">ذخیره تغییرات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
