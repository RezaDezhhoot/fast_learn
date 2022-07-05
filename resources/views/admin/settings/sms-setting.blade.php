<div>
    @section('title','تنظیمات متن های ارسالی')
    <x-admin.form-control  title="تنظیمات "/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <x-admin.form-section label="سفارش ها">
                <div class="row mx-2 py-2">
                    @foreach($variables['orders'] as $key => $value)
                        <div class="col-2">
                            <p class="text-base m-0"> {{$key}} </p>
                            <small class="text-info">{{$value}}</small>
                        </div>
                    @endforeach
                </div>
                <x-admin.forms.text-area id="order_cmpleted" label="تکمیل سفارش" wire:model.defer="order_completed"/>
                <x-admin.forms.text-area id="order_processing" label="در حال پردازش" wire:model.defer="order_processing"/>
                <x-admin.forms.text-area id="order_cancelled" label="در انتظار بازگشت وجه" wire:model.defer="order_cancelled"/>
                <x-admin.forms.text-area id="order_refunded" label="بازگشت وجه" wire:model.defer="order_refunded"/>
            </x-admin.form-section>
            <x-admin.form-section label="تیکت ها">
                <div class="row mx-2 py-2">
                    @foreach($variables['tickets'] as $key => $value)
                        <div class="col-2">
                            <p class="text-base m-0"> {{ $key }} </p>
                            <small class="text-info">{{$value}}</small>
                        </div>
                    @endforeach
                </div>
                <x-admin.forms.text-area id="ticket_new" label="ارسال تیکت جدید" wire:model.defer="ticket_new"/>
                <x-admin.forms.text-area id="ticket_answer" label="پاسخ به تیکت" wire:model.defer="ticket_answer"/>
            </x-admin.form-section>
            <x-admin.form-section label="احراز هویت">
                <div class="row mx-2 py-2">
                    @foreach($variables['auth'] as $key => $value)
                        <div class="col-2">
                            <p class="text-base m-0"> {{ $key }} </p>
                            <small class="text-info">{{$value}}</small>
                        </div>
                    @endforeach
                </div>
                <x-admin.forms.text-area id="auth_login" label="ورود" wire:model.defer="auth_login"/>
                <x-admin.forms.text-area id="auth_register" label="ثبت نام" wire:model.defer="auth_register"/>
            </x-admin.form-section>
            <x-admin.form-section label="امتحان ها">
                <div class="row mx-2 py-2">
                    @foreach($variables['exams'] as $key => $value)
                        <div class="col-2">
                            <p class="text-base m-0"> {{ $key }} </p>
                            <small class="text-info">{{$value}}</small>
                        </div>
                    @endforeach
                </div>
                <x-admin.forms.text-area id="exam_passed" label="قبول شدن در ازمون" wire:model.defer="exam_passed"/>
                <x-admin.forms.text-area id="exam_rejected" label="رد شدن در ازمون" wire:model.defer="exam_rejected"/>
            </x-admin.form-section>
        </div>
    </div>
</div>
