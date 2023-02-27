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

               <x-admin.forms.checkbox value="1" id="users_can_send_teacher_request" name="users_can_send_teacher_request" label="کاربران می توانند مدرس شوند" wire:model.defer="users_can_send_teacher_request" />

           </div>
            <x-admin.form-section  label="فضا های ذخیره سازی ">
                <div class="border p-3">
                    <x-admin.form-section  label="private : ">
                        <x-admin.forms.input type="number" help="درصورت خالی گذاشتن بدون محدودیت قرار داده می شود" id="private_max_file_size" label="حداکثر حجم مجاز اپلود فایل(KB)" wire:model.defer="private_max_file_size"/>
                        <x-admin.forms.text-area id="private_storage_file_types" label="فرمت فای های مجاز" help="در صورت خالی گذاشتن محدودیتی اعمال نمی شود. فرمت هارا با کاما از هم جدا کنید : png,PNG,zip" wire:model.defer="private_storage_file_types"/>
                    </x-admin.form-section>
                    <x-admin.form-section  label="public : ">
                        <x-admin.forms.input type="number" help="درصورت خالی گذاشتن بدون محدودیت قرار داده می شود" id="public_max_file_size" label="حداکثر حجم مجاز اپلود فایل(KB)" wire:model.defer="public_max_file_size"/>
                        <x-admin.forms.text-area id="public_storage_file_types" label="فرمت فای های مجاز" help="در صورت خالی گذاشتن محدودیتی اعمال نمی شود. فرمت هارا با کاما از هم جدا کنید : png,PNG,zip" wire:model.defer="public_storage_file_types"/>
                    </x-admin.form-section>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="درگاه های بانکی">
                <div class="border p-3">
                    <x-admin.forms.checkbox value="zarinpal" id="zarinpal" name="gateway" label="zarinpal" wire:model="gateway" />
                        <div class="row {{!in_array('zarinpal',$gateway) ? 'd-none' : ''}}">
                            <x-admin.forms.input with="6" type="text" id="merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="zarin_merchantId"/>
                            <x-admin.forms.dropdown with="6" id="zarin_mode" :data="['normal'=>'عادی','sandbox'=>'ازمایشی','zaringate'=> 'zaringate']" label="حالت" wire:model.defer="zarin_mode"/>
                            <x-admin.forms.dropdown help="برای درگاه zarinpal واحد تومان می باشد" id="zarin_unit" :data="['1'=> 'تومان','10'=> 'ریال']" label="واحد" wire:model.defer="zarin_unit"/>
                            <x-admin.forms.lfm-standalone id="zarin_logo" label="لوگو درگاه" :file="$zarin_logo" type="image"  wire:model="zarin_logo"/>
                        </div>
                    <hr>
                    <x-admin.forms.checkbox value="payir" id="payid" name="gateway" label="pay.ir" wire:model="gateway" />
                        <div class="row {{!in_array('payir',$gateway) ? 'd-none' : ''}}">
                            <x-admin.forms.input type="text" id="payir_merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="payir_merchantId"/>
                            <x-admin.forms.dropdown help="برای درگاه pay واحد تومان می باشد" id="payir_unit" :data="['1'=> 'تومان','10'=> 'ریال']" label="واحد" wire:model.defer="payir_unit"/>
                            <x-admin.forms.lfm-standalone id="payir_logo" label="لوگو درگاه" :file="$payir_logo" type="image"  wire:model="payir_logo"/>
                        </div>
                    <hr>
                    <x-admin.forms.checkbox value="idpay" id="idpay" name="gateway" label="idpay" wire:model="gateway" />
                        <div class="row {{!in_array('idpay',$gateway) ? 'd-none' : ''}}">
                            <x-admin.forms.input with="6" type="text" id="idpay_merchantId" placeholder="merchantId" label="شناسه درگاه" wire:model.defer="idpay_merchantId"/>
                            <x-admin.forms.dropdown with="6" id="idpay_sandbox" :data="['0'=>'خیر','1'=>'بعله']" label="درگاه ازمایشی" wire:model.defer="idpay_sandbox"/>
                            <x-admin.forms.lfm-standalone id="idpay_logo" label="لوگو درگاه" :file="$idpay_logo" type="image"  wire:model="idpay_logo"/>
                            <x-admin.forms.dropdown id="idpay_unit" help="برای درگاه ای دی پی واحد ریال می باشد" :data="['10'=>'ریال','1'=>'تومان']" label="واحد" wire:model.defer="idpay_unit"/>
                        </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="روش ارسال کد تایید احراز هویت ">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio help="توجه داشته باشید سرویس OTP باید روی پنل پیامکی شما فعال باشد" name="auth_type" value="{{\App\Enums\NotificationEnum::SMS_METHOD}}" id="otp"  label="ارسال اس ام اس (سرویس OTP)" wire:model="auth_type" />
                        <x-admin.forms.radio help="ارسال ایمیل با استفاده از سرویس SMTP انجام می شود" name="auth_type" value="{{\App\Enums\NotificationEnum::EMAIL_METHOD}}" id="email"  label="ارسال ایمیل" wire:model="auth_type" />
                        <x-admin.forms.radio help="عدم ارسال اعلان احراز هویت" name="auth_type" value="{{\App\Enums\NotificationEnum::NONE_METHOD}}" id="none"  label="غیر فعال" wire:model="auth_type" />
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="روش ارسال کلیه اعلان ها ">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio name="send_type" value="{{\App\Enums\NotificationEnum::SMS_METHOD}}" id="send_otp"  label="ارسال اس ام اس " wire:model.defer="send_type" />
                        <x-admin.forms.radio help="ارسال ایمیل با استفاده از سرویس SMTP انجام می شود" name="send_type" value="{{\App\Enums\NotificationEnum::EMAIL_METHOD}}" id="send_email"  label="ارسال ایمیل" wire:model.defer="send_type" />
                        <x-admin.forms.radio  name="send_type" value="{{\App\Enums\NotificationEnum::BOTH_METHODS}}" id="send_both"  label="ارسال همزمان ایمیل و sms" wire:model.defer="send_type" />
                        <x-admin.forms.radio help=" اعلان ها به صورت پیشفرض به وسیله نوتیفیکشن های داخلی ارسال می شوند" name="send_type" value="{{\App\Enums\NotificationEnum::NONE_METHOD}}" id="send_none"  label="غیر فعال" wire:model="send_type" />

                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="زمان ارسال اعلان ها">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio name="notify_should_be_queueable" help="توجه : این قابلیت روی هاست اشتراکی پشتیبانی نمی شود" value="1" id="notify_should_be_queueable"  label="اعلان ها در صف ارسال قرار بگیرند" wire:model.defer="notify_should_be_queueable" />
                        <x-admin.forms.radio  name="notify_should_be_queueable" value="0" id="notify_send_now"  label="ارسال آنی اعلان" wire:model.defer="notify_should_be_queueable" />
                    </div>
                </div>
            </x-admin.form-section>
            <x-admin.form-section  label="زمان پردازش ازمون ها">
                <div class="border p-3">
                    <div class="row">
                        <x-admin.forms.radio name="exam_should_be_queueable" help="توجه : این قابلیت روی هاست اشتراکی پشتیبانی نمی شود" value="1" id="exam_should_be_queueable"  label="ازمون ها در صف پردازش قرار بگیرند" wire:model.defer="exam_should_be_queueable" />
                        <x-admin.forms.radio  name="exam_should_be_queueable" value="0" id="notify_send_now"  label="پردازش آنی ازمون" wire:model.defer="exam_should_be_queueable" />
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

            <x-admin.form-section  label="ارتباط با برنامه نویس">
                <small class="text-info">در صورت تمایل به دریافت اطلاع از بروزرسانی ها می توانید اطلاعات خود را وارد نمایید</small>
               <div class="row">
                   <x-admin.forms.input with="6" type="text" id="update_email" label="ایمیل" wire:model.defer="update_email"/>
                   <x-admin.forms.input with="6" type="text" id="update_phone" label="شماره همراه" wire:model.defer="update_phone"/>
                  <div class="col-6">
                      <button wire:click="update_info" class="btn btn-primary">ثبت اطلاعات</button>
                  </div>
               </div>
            </x-admin.form-section>
        </div>
    </div>
</div>
