<div>
    @section('title','ارگان')
    <x-admin.form-control deleteAble="true" deleteContent="حذف ارگان" mode="{{$mode}}" title="ارگان" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors />
        <div class="card-body">
            @if($mode == self::UPDATE_MODE)
                <x-admin.form-section label="مدیر">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>کد کاربر</th>
                                    <td>نام</td>
                                    <td>شماره همراه</td>
                                    <td>وضعیت</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $organ->user->id }}</td>
                                    <td>{{ $organ->user->name }}</td>
                                    <td>{{ $organ->user->phone }}</td>
                                    <td>{{ $organ->user->status_label }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-admin.form-section>
            @endif
            <div class="row">
                <x-admin.forms.input with="6" disabled type="text" id="slug" label="نام مستعار*" wire:model.defer="slug"/>
                <x-admin.forms.input with="6" type="text" id="title" label="عنوان*" wire:model.defer="title"/>
                <x-admin.forms.input with="6" type="number" id="percent" label="درصد مشارکت" wire:model.defer="percent"/>
                <x-admin.forms.dropdown with="6" id="status" :data="$data['status']" label="وضعیت*" wire:model.defer="status"/>
                @if($mode == self::CREATE_MODE)
                    <x-admin.forms.input  type="text" id="user" label="شماره همراه کاربر*" wire:model.defer="user"/>
                @endif
                <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
                <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />
            </div>
                <x-admin.form-section label="اطلاعات ثبت شده">
                   <div class="row">
                       <x-admin.forms.input  type="text" id="address" label="ادرس" wire:model.defer="address"/>
                       <x-admin.forms.input with="6"  type="email" id="email" label="ایمیل" wire:model.defer="email"/>
                       <x-admin.forms.input with="6" type="text" id="phone1" label="شماره1" wire:model.defer="phone1"/>
                       <x-admin.forms.input with="6" type="text" id="phone2" label="شماره2" wire:model.defer="phone2"/>
                       <x-admin.forms.dropdown with="6" id="province" :data="$data['province']" label="استان" wire:model="province"/>
                       <x-admin.forms.dropdown with="6" id="city" :data="$data['city']" label="شهر" wire:model.defer="city"/>
                       <x-admin.forms.input with="6" type="text" id="web_site" label="وبسایت" wire:model.defer="web_site"/>
                       <x-admin.forms.lfm-standalone with="6" id="logo" label="لوگو" :file="$logo" type="image" required="true" wire:model="logo"/>
                       <x-admin.forms.lfm-standalone with="6" id="image" label="تصویر" :file="$image" type="image" required="true" wire:model="image"/>
                       <x-admin.forms.full-text-editor id="description" label="توضیحات" wire:model.defer="description"/>
                   </div>
                </x-admin.form-section>
                @if($mode == self::UPDATE_MODE)
                <x-admin.form-section label="اطلاعات جدید">
                    <div class="row">
                        <x-admin.forms.input type="text" id="transcript-address" label="ادرس{{ @$transcript['address'] != $address ? '(جدید)' : '' }}" wire:model.defer="transcript.address"/>
                        <x-admin.forms.input with="6"  type="email" id="transcript-email" label="ایمیل{{ @$transcript['email'] != $email ? '(جدید)' : '' }}" wire:model.defer="transcript.email"/>
                        <x-admin.forms.input with="6" type="text" id="transcript-phone1" label="شماره1 {{ @$transcript['phone1'] != $phone1 ? '(جدید)' : '' }}" wire:model.defer="transcript.phone1"/>
                        <x-admin.forms.input with="6" type="text" id="transcript-phone2" label=" {{ @$transcript['phone2'] != $phone2 ? '(جدید)' : '' }}شماره2" wire:model.defer="transcript.phone2"/>
                        <x-admin.forms.dropdown with="6" id="transcript-province" :data="$data['province']" label="استان {{ @$transcript['province'] != $province ? '(جدید)' : '' }}" wire:model="transcript.province"/>
                        <x-admin.forms.dropdown with="6" id="transcript-city" :data="$data['city2']" label="شهر {{ @$transcript['city'] != $city ? '(جدید)' : '' }}" wire:model.defer="transcript.city"/>
                        <x-admin.forms.input with="6" type="text" id="transcript-web_site" label="وبسایت {{ @$transcript['web_site'] != $web_site ? '(جدید)' : '' }}" wire:model.defer="transcript.web_site"/>

                        <x-admin.forms.lfm-standalone with="6" id="transcript-logo" label="لوگو" :file="$transcript['logo']" type="image" required="true" wire:model="transcript.logo"/>
                        <x-admin.forms.lfm-standalone with="6" id="transcript-image" label="تصویر" :file="$transcript['image']" type="image" required="true" wire:model="transcript.image"/>
                        <x-admin.forms.full-text-editor id="transcript-description" label="توضیحات" wire:model.defer="transcript.description"/>
                        <div class="col-12">
                            <button class="btn btn-outline-primary" wire:click="confirmTranscript">تایید</button>
                        </div>
                    </div>
                </x-admin.form-section>
                @endif
        </div>
    </div>
</div>
