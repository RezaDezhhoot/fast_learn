<div>
    @section('title','تنظیمات پایه')
    <x-admin.form-control title="تنطیمات "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
           <div class="row">
               <x-admin.forms.input type="text" id="name" label="نام سایت*" wire:model.defer="name"/>
               <x-admin.forms.input type="text" id="title" label="عنوان سایت*" wire:model.defer="title"/>
               <x-admin.forms.lfm-standalone id="logo" label="لوگو سایت*" :file="$logo" type="image" required="true" wire:model="logo"/>
               <x-admin.forms.input type="text" id="registerGift" label="هدیه ثبت نام(تومان)" wire:model.defer="registerGift"/>
               <x-admin.forms.text-area label="توضیحات سئو*" id="seoDescription" wire:model.defer="seoDescription" />
               <x-admin.forms.text-area label="کلمات سئو*" help="کلمات را با کاما از هم جدا کنید" id="seoKeyword" wire:model.defer="seoKeyword" />
               <x-admin.forms.text-area id="copyRight" label="متن کپی رایت" wire:model.defer="copyRight"/>

               <x-admin.forms.text-area label="google recaptcha site key*" id="site_key" wire:model.defer="site_key" />
               <x-admin.forms.text-area label="google recaptcha secret key*" id="secret_key" wire:model.defer="secret_key" />
           </div>
            <x-admin.form-section  label="فضای ذخیره سازی پیشفرض">
                <div class="border p-3">
                    <x-admin.forms.radio value="1" id="local_storage" name="storage" label="local driver" wire:model="storage" />
                    <hr>
                    <x-admin.forms.radio value="2" id="ftp_storage" name="storage" label="ftp driver" wire:model="storage" />
                    @if($storage == 2)
                        <div class="row">
                            <x-admin.forms.input with="6" type="text" id="storage_root" placeholder="root" label="root" wire:model.defer="ftp_root"/>
                            <x-admin.forms.input with="6" type="text" id="storage_ip" placeholder="ip/domain" label="ip/domain" wire:model.defer="ftp_ip"/>
                            <x-admin.forms.input with="6" type="text" id="storage_username" placeholder="username" label="username" wire:model.defer="ftp_username"/>
                            <x-admin.forms.input with="6" type="text" id="storage_password" placeholder="password" label="password" wire:model.defer="ftp_password"/>
                            <x-admin.forms.input with="12" type="number" id="storage_port" placeholder="port" label="port" wire:model.defer="ftp_port"/>
                            <x-admin.forms.checkbox value="1" id="storage_ssl"  label="ssl" wire:model.defer="ftp_ssl" />
                            <x-admin.forms.checkbox value="1" id="ftp_available"  label="فعال سازی" wire:model.defer="ftp_available" />
                        </div>
                    @endif
                    <hr>
                    <x-admin.forms.radio value="3" id="s3_storage" name="storage" label="Amazon S3 driver" wire:model="storage" />
                    @if($storage == 3)
                        <div class="row">
                            <x-admin.forms.input with="6" type="text" id="s3_key" placeholder="key" label="key" wire:model.defer="s3_key"/>
                            <x-admin.forms.input with="6" type="text" id="s3_secret" placeholder="secret" label="secret" wire:model.defer="s3_secret"/>
                            <x-admin.forms.input with="6" type="text" id="s3_region" placeholder="region" label="region" wire:model.defer="s3_region"/>
                            <x-admin.forms.input with="6" type="text" id="s3_bucket" placeholder="bucket" label="bucket" wire:model.defer="s3_bucket"/>
                            <x-admin.forms.input with="6" type="text" id="s3_url" placeholder="url" label="url" wire:model.defer="s3_url"/>
                            <x-admin.forms.input with="6" type="text" id="s3_endpoint" placeholder="endpoint" label="endpoint" wire:model.defer="s3_endpoint"/>
                            <x-admin.forms.checkbox value="1" id="use_path_style_endpoint"  label="use path style endpoint" wire:model.defer="s3_use_path_style_endpoint" />
                            <x-admin.forms.checkbox value="1" id="s3_available"  label="فعال سازی" wire:model.defer="s3_available" />
                        </div>
                    @endif
                    <hr>
                    <x-admin.forms.radio value="4" id="sftp_storage" name="storage" label="SFTP driver" wire:model="storage" />
                    @if($storage == 4)
                        <div class="row">
                            <x-admin.forms.input with="6" type="text" id="sftp_host" placeholder="host" label="host" wire:model.defer="sftp_host"/>
                            <x-admin.forms.input with="6" type="text" id="sftp_username" placeholder="username" label="username" wire:model.defer="sftp_username"/>
                            <x-admin.forms.input with="6" type="text" id="sftp_password" placeholder="password" label="password" wire:model.defer="sftp_password"/>
                            <x-admin.forms.input with="6" type="text" id="sftp_privateKey" placeholder="privateKey" label="privateKey" wire:model.defer="sftp_privateKey"/>
                            <x-admin.forms.input with="6" type="text" id="sftp_hostFingerprint" placeholder="hostFingerprint" label="hostFingerprint" wire:model.defer="sftp_hostFingerprint"/>
                            <x-admin.forms.input with="6" type="number" id="sftp_maxTries" placeholder="maxTries" label="maxTries" wire:model.defer="sftp_maxTries"/>
                            <x-admin.forms.input with="6" type="text" id="sftp_passphrase" placeholder="passphrase" label="passphrase" wire:model.defer="sftp_passphrase"/>
                            <x-admin.forms.input with="6" type="number" id="sftp_port" placeholder="port" label="port" wire:model.defer="sftp_port"/>
                            <x-admin.forms.input with="12" type="text" id="sftp_root" placeholder="root" label="root" wire:model.defer="sftp_root"/>
                            <x-admin.forms.checkbox value="1" id="sftp_useAgent"  label="use agent" wire:model.defer="sftp_useAgent" />
                            <x-admin.forms.checkbox value="1" id="sftp_available"  label="فعال سازی" wire:model.defer="sftp_available" />

                        </div>
                    @endif
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="درگاه های بانکی">
                <div class="border p-3">
                    <x-admin.forms.checkbox value="zarinpal" id="zarinpal" name="gateway" label="zarinpal" wire:model="gateway" />
                    @if(in_array('zarinpal',$gateway))
                        <div class="row">
                            <x-admin.forms.input with="6" type="text" id="merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="zarin_merchantId"/>
                            <x-admin.forms.dropdown with="6" id="zarin_mode" :data="['normal'=>'normal','sandbox'=>'sandbox','zaringate'=> 'zaringate']" label="mode" wire:model.defer="zarin_mode"/>
                            <x-admin.forms.dropdown help="برای درگاه zarinpal واحد تومان می باشد" id="zarin_unit" :data="['1'=> 'تومان','10'=> 'ریال']" label="واحد" wire:model.defer="zarin_unit"/>
                            <x-admin.forms.lfm-standalone id="zarin_logo" label="لوگو درگاه" :file="$zarin_logo" type="image"  wire:model="zarin_logo"/>
                        </div>
                    @endif
                    <hr>
                    <x-admin.forms.checkbox value="payir" id="payid" name="gateway" label="pay.ir" wire:model="gateway" />
                    @if(in_array('payir',$gateway))
                        <div class="row">
                            <x-admin.forms.input type="text" id="payir_merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="payir_merchantId"/>
                            <x-admin.forms.dropdown help="برای درگاه pay واحد تومان می باشد" id="payir_unit" :data="['1'=> 'تومان','10'=> 'ریال']" label="واحد" wire:model.defer="payir_unit"/>
                            <x-admin.forms.lfm-standalone id="payir_logo" label="لوگو درگاه" :file="$payir_logo" type="image"  wire:model="payir_logo"/>
                        </div>
                    @endif
                    <hr>
                    <x-admin.forms.checkbox value="idpay" id="idpay" name="gateway" label="idpay" wire:model="gateway" />
                    @if(in_array('idpay',$gateway))
                        <div class="row">
                            <x-admin.forms.input with="6" type="text" id="idpay_merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="idpay_merchantId"/>
                            <x-admin.forms.dropdown with="6" id="idpay_sandbox" :data="['0'=>'false','1'=>'true']" label="درگاه ازمایشی" wire:model.defer="idpay_sandbox"/>
                            <x-admin.forms.lfm-standalone id="idpay_logo" label="لوگو درگاه" :file="$idpay_logo" type="image"  wire:model="idpay_logo"/>
                            <x-admin.forms.dropdown id="idpay_unit" help="برای درگاه ای دی پی واحد ریال می باشد" :data="['10'=>'ریال','1'=>'تومان']" label="واحد" wire:model.defer="idpay_unit"/>
                        </div>
                    @endif
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="روش ارسال کد تایید احراز هویت ">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio help="توجه داشته باشید سرویس OTP باید روی پنل پیامکی شما فعال باشد" name="auth_type" value="otp" id="otp"  label="ارسال اس ام اس (سرویس OTP)" wire:model="auth_type" />
                        <x-admin.forms.radio help="ارسال ایمیل با استفاده از سرویس SMTP انجام می شود" name="auth_type" value="email" id="email"  label="ارسال ایمیل" wire:model="auth_type" />
                    </div>
                </div>
            </x-admin.form-section>

            <x-admin.form-section  label="روش ارسال کلیه اعلان ها ">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio name="send_type" value="sms" id="send_otp"  label="ارسال اس ام اس " wire:model.defer="send_type" />
                        <x-admin.forms.radio help="ارسال ایمیل با استفاده از سرویس SMTP انجام می شود" name="send_type" value="email" id="send_email"  label="ارسال ایمیل" wire:model.defer="send_type" />
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="مشخصات پنل پیامکی <a href='https://farazsms.com/'>فراز اس ام اس (پکیج اقتصادی)</a>">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.input with="6" type="text" id="faraz_username" placeholder="نام کاربری" label="نام کاربری" wire:model.defer="faraz_username"/>
                        <x-admin.forms.input with="6" type="text" id="faraz_password" placeholder="گذرواژه" label="گذرواژه" wire:model.defer="faraz_password"/>
                        <x-admin.forms.input with="6" type="text" id="faraz_apiKey" placeholder="شناسه api" label="شناسه api" wire:model.defer="faraz_apiKey"/>
                        <x-admin.forms.input with="6" type="text" id="faraz_line" placeholder="شماره خط" label="شماره خط" wire:model.defer="faraz_line"/>
                    </div>
                    <x-admin.form-section  label="سرویس OTP">
                        <div class="border p-3">
                            <div class="row">
                                <x-admin.forms.input with="6" type="text" id="faraz_pattern" placeholder="نام پترن" label="نام پترن" wire:model.defer="faraz_pattern"/>
                                <x-admin.forms.input with="6" type="text" id="faraz_var" placeholder="متغیر پترن" label="متغیر پترن" wire:model.defer="faraz_var"/>
                            </div>
                        </div>
                    </x-admin.form-section>
                </div>
            </x-admin.form-section>

            <x-admin.form-section  label="مشخصات حساب ایمیل">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.input with="6" type="text" id="email_host" placeholder="DNS/DOMAIN" label="DNS/DOMAIN" wire:model.defer="email_host"/>
                        <x-admin.forms.input with="6" type="text" id="email_username" placeholder="نام کاربری" label="نام کاربری" wire:model.defer="email_username"/>
                        <x-admin.forms.input type="text" id="email_password" placeholder="گذرواژه" label="گذرواژه" wire:model.defer="email_password"/>
                    </div>
                </div>

            </x-admin.form-section>

            <x-admin.form-section  label="نماد های اعتماد">
                <div class="border p-3">
                    <x-admin.button class="btn btn-light-primary font-weight-bolder btn-sm" content="افزودن نماد" wire:click="addAutograph()" />
                    @foreach($autographs as $key => $item)
                        <div class="form-group d-flex align-items-center col-12">
                            <input class="form-control col-11" id="{{ $key }}autographs" type="text" placeholder="کد" wire:model.defer="autographs.{{$key}}">
                            <div><button class="btn btn-light-danger font-weight-bolder btn-sm" wire:click="deleteAutograph({{ $key }})">حذف</button></div>
                        </div>
                    @endforeach
                </div>

            </x-admin.form-section>
        </div>
    </div>
</div>
