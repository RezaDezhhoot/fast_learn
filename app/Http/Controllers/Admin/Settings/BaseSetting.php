<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Enums\StorageEnum;
class BaseSetting extends BaseComponent
{
    public $header , $name , $logo , $status , $title  , $copyRight  ;
    public   $i = 1 , $registerGift , $notification  , $seoDescription , $seoKeyword , $footerText ;

    public $faraz_apiKey = '' , $faraz_password = '' , $faraz_username = '', $faraz_line = '' , $faraz_pattern = '' , $faraz_var = '';

    public $gateway = [];

    public $zarin_merchantId , $zarin_mode , $zarin_logo , $payir_merchantId , $payir_logo , $idpay_merchantId , $idpay_sandbox , $idpay_logo;
    public $zarin_unit , $payir_unit , $idpay_unit;

    public $email_host = '' , $email_username = '' , $email_password = '';

    public $autographs = [];

    public $auth_type , $send_type;

    public $site_key , $secret_key;

    public $update_email , $update_phone;

    public $private_storage_file_types , $private_max_file_size;

    public $public_storage_file_types , $public_max_file_size;



    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_base');
        $this->header = 'تنظیمات پایه';
        $this->data['status'] = ['0' => 'بسته','1' => 'باز'];

        $this->site_key = $this->settingRepository->getRow('site_key');
        $this->secret_key = $this->settingRepository->getRow('secret_key');

        $this->autographs = $this->settingRepository->getRow('autographs',[]);

        $this->auth_type = $this->settingRepository->getRow('auth_type');
        $this->send_type = $this->settingRepository->getRow('send_type');

        $this->email_host = $this->settingRepository->getRow('email_host') ?? '';
        $this->email_username = $this->settingRepository->getRow('email_username') ?? '';
        $this->email_password = $this->settingRepository->getRow('email_password') ?? '';

        $this->faraz_apiKey = $this->settingRepository->getRow('faraz_apiKey') ?? '';
        $this->faraz_password = $this->settingRepository->getRow('faraz_password') ?? '';
        $this->faraz_username = $this->settingRepository->getRow('faraz_username') ?? '';
        $this->faraz_line = $this->settingRepository->getRow('faraz_line') ?? '';
        $this->faraz_pattern = $this->settingRepository->getRow('faraz_pattern') ?? '';
        $this->faraz_var = $this->settingRepository->getRow('faraz_var') ?? '';

        $this->gateway = $this->settingRepository->getRow('gateway',[]);
        $this->zarin_merchantId = $this->settingRepository->getRow('zarinpal_merchantId');
        $this->zarin_mode = $this->settingRepository->getRow('zarinpal_mode');
        $this->zarin_logo = $this->settingRepository->getRow('zarinpal_logo');
        $this->zarin_unit = $this->settingRepository->getRow('zarinpal_unit');
        $this->payir_merchantId = $this->settingRepository->getRow('payir_merchantId');
        $this->payir_logo = $this->settingRepository->getRow('payir_logo');
        $this->payir_unit = $this->settingRepository->getRow('payir_unit');
        $this->idpay_merchantId = $this->settingRepository->getRow('idpay_merchantId');
        $this->idpay_sandbox = $this->settingRepository->getRow('idpay_sandbox');
        $this->idpay_logo = $this->settingRepository->getRow('idpay_logo');
        $this->idpay_unit = $this->settingRepository->getRow('idpay_unit');

        $this->copyRight = $this->settingRepository->getRow('copyRight');
    
        $this->logo = $this->settingRepository->getRow('logo');
        $this->title = $this->settingRepository->getRow('title');
        $this->name = $this->settingRepository->getRow('name');
        $this->registerGift = $this->settingRepository->getRow('registerGift');

        $this->seoDescription = $this->settingRepository->getRow('seoDescription');
        $this->seoKeyword = $this->settingRepository->getRow('seoKeyword');

        $this->update_email = $this->settingRepository->getRow('update_email');
        $this->update_phone = $this->settingRepository->getRow('update_phone');

        $this->private_storage_file_types = $this->settingRepository->getRow('private_storage_file_types');
        $this->private_max_file_size = $this->settingRepository->getRow('private_max_file_size');

        $this->public_storage_file_types = $this->settingRepository->getRow('public_storage_file_types');
        $this->public_max_file_size = $this->settingRepository->getRow('public_max_file_size');
    }

    public function render()
    {
        return view('admin.settings.base-setting')
            ->extends('admin.layouts.admin');
    }

    public function store()
    {
        $this->authorizing('edit_settings_base');
        $this->validate(
            [
                'name' => ['required', 'string','max:120'],
                'title' => ['required','string','max:120'],
                'logo' => ['required','required','max:300'],
                'registerGift' => ['nullable','numeric','between:0,99999999999.999999'],
                'autographs' => ['nullable','array'],
                'autographs.*' => ['required','string','max:33000'],
                'seoDescription' => ['required','string','max:400'],
                'seoKeyword' => ['required','string','max:400'],
                'gateway' => ['array'],
                'zarin_merchantId' => ['nullable','string','max:1000'],
                'zarin_logo' => ['nullable','string','max:550000'],
                'zarin_mode' => ['nullable','string','in:normal,sandbox,zaringate'],
                'zarin_unit' => ['nullable','string','in:1,10'],
                'payir_merchantId' => ['nullable','string','max:1000'],
                'payir_logo' => ['nullable','string','max:550000'],
                'payir_unit' => ['nullable','string','in:1,10'],
                'idpay_logo' => ['nullable','string','max:550000'],
                'idpay_merchantId' => ['nullable','string','max:1000'],
                'idpay_sandbox' => ['nullable','string','in:0,1'],
                'idpay_unit' => ['nullable','string','in:1,10'],

                'private_storage_file_types' => ['nullable','string','max:4000'],
                'private_max_file_size' => ['nullable','integer','min:1024'],
                'public_storage_file_types' => ['nullable','string','max:4000'],
                'public_max_file_size' => ['nullable','integer','min:1024'],
                
                'faraz_apiKey' => [Rule::requiredIf(fn() => $this->auth_type == 'otp' || $this->send_type == 'sms'),'string','max:1000'],
                'faraz_password' => [Rule::requiredIf(fn() => $this->auth_type == 'otp' || $this->send_type == 'sms'),'string','max:1000'],
                'faraz_username' => [Rule::requiredIf(fn() => $this->auth_type == 'otp' || $this->send_type == 'sms'),'string','max:1000'],
                'faraz_line' => [Rule::requiredIf(fn() => $this->auth_type == 'otp' || $this->send_type == 'sms'),'string','max:1000'],
                'faraz_pattern' => [Rule::requiredIf(fn() => $this->auth_type == 'otp'),'string','max:1000'],
                'faraz_var' => [Rule::requiredIf(fn() => $this->auth_type == 'otp'),'string','max:1000'],

                'email_host' => [Rule::requiredIf(fn() => $this->auth_type == 'email' || $this->send_type == 'email'),'string','max:1000'],
                'email_username' => [Rule::requiredIf(fn() => $this->auth_type == 'email' || $this->send_type == 'email'),'string','max:1000'],
                'email_password' => [Rule::requiredIf(fn() => $this->auth_type == 'email' || $this->send_type == 'email'),'string','max:1000'],

                'auth_type' => ['required','in:otp,email,none'],
                'send_type' => ['required','in:sms,email,none'],

                'site_key' => ['required','max:2000'],
                'secret_key' => ['required','max:2000'],
            ] , [] ,
            [
                'name' => 'نام سایت',
                'title' => 'عنوان سایت',
                'logo' => 'لوکو سایت',
                'registerGift' => 'هدیه ثبت نام',
                'autographs' => 'نماد های اعتماد',
                'autographs.*' => 'نماد های اعتماد',
                'seoDescription' => 'توضیحات سئو',
                'seoKeyword' => 'کلمات سئو',

                'zarin_merchantId' => 'شناسه درگاه زرین پال',
                'zarin_mode' => 'حالت درگاه زرین پال',
                'zarin_logo' => 'لوگو درگاه زرین پال',
                'zarin_unit' => 'واحد درگاه زرین پال',
                'payir_merchantId' => ' شناسه درگاه پی',
                'payir_logo' => ' لوگو درگاه پی',
                'payir_unit' => 'واحد درگاه پی',
                'idpay_logo' => 'لوگو درگاه ای دی پی',
                'idpay_merchantId' => 'شناسه درگاه ای دی پی',
                'idpay_sandbox' => 'حالت درگاه ای دی پی',
                'idpay_unit' => 'واحد درگاه ای دی پی',

                'private_storage_file_types' => 'فرمت فایل های مجاز درایور private',
                'private_max_file_size' => 'حداکثر حجم مجاز اپلود فایل درایور private',
                'public_storage_file_types' => 'فرمت فایل های مجاز درایور public',
                'public_max_file_size' => 'حداکثر حجم مجاز اپلود فایل درایور public',

                'faraz_apiKey' => 'شناسه api فراز اس ام اس',
                'faraz_password' => 'گذرواژه فراز اس ام اس',
                'faraz_username' => 'نام کاربری فراز اس ام اس',
                'faraz_line' => 'شماره خط فراز اس ام اس',
                'faraz_pattern' => 'نام پترن فراز اس ام اس',
                'faraz_var' => 'متغیر پترن فراز اس ام اس',

                'email_host' => 'email DNS/DOMAIN',
                'email_username' => 'نام کاربری ایمیل',
                'email_password' => 'گذرواژه ایمیل',

                'auth_type' => 'سیستم احراز هویت',
                'send_type' => 'سیستم ارسال اعلان ها',

                'site_key' => 'google recaptcha site key',
                'secret_key' => 'google recaptcha secret key',
            ]
        );

        $this->settingRepository::updateOrCreate(['name' => 'site_key'], ['value' => $this->site_key]);
        $this->settingRepository::updateOrCreate(['name' => 'secret_key'], ['value' => $this->secret_key]);

        $this->settingRepository::updateOrCreate(['name' => 'private_storage_file_types'], ['value' => $this->private_storage_file_types]);
        $this->settingRepository::updateOrCreate(['name' => 'private_max_file_size'], ['value' => $this->private_max_file_size]);

        $this->settingRepository::updateOrCreate(['name' => 'public_storage_file_types'], ['value' => $this->public_storage_file_types]);
        $this->settingRepository::updateOrCreate(['name' => 'public_max_file_size'], ['value' => $this->public_max_file_size]);

        $this->settingRepository::updateOrCreate(['name' => 'auth_type'], ['value' => $this->auth_type]);
        $this->settingRepository::updateOrCreate(['name' => 'send_type'], ['value' => $this->send_type]);

        $this->settingRepository::updateOrCreate(['name' => 'email_host'], ['value' => trim($this->email_host)]);
        $this->settingRepository::updateOrCreate(['name' => 'email_username'], ['value' => trim($this->email_username)]);
        $this->settingRepository::updateOrCreate(['name' => 'email_password'], ['value' => trim($this->email_password)]);

        $this->settingRepository::updateOrCreate(['name' => 'faraz_apiKey'], ['value' => trim($this->faraz_apiKey)]);
        $this->settingRepository::updateOrCreate(['name' => 'faraz_password'], ['value' => trim($this->faraz_password)]);
        $this->settingRepository::updateOrCreate(['name' => 'faraz_username'], ['value' => trim($this->faraz_username)]);
        $this->settingRepository::updateOrCreate(['name' => 'faraz_line'], ['value' => trim($this->faraz_line)]);
        $this->settingRepository::updateOrCreate(['name' => 'faraz_pattern'], ['value' => trim($this->faraz_pattern)]);
        $this->settingRepository::updateOrCreate(['name' => 'faraz_var'], ['value' => trim($this->faraz_var)]);

        $this->settingRepository::updateOrCreate(['name' => 'gateway'], ['value' => json_encode($this->gateway)]);
        $this->settingRepository::updateOrCreate(['name' => 'zarinpal_merchantId'], ['value' => trim($this->zarin_merchantId)]);
        $this->settingRepository::updateOrCreate(['name' => 'zarinpal_title'], ['value' => 'زرین پال']);
        $this->settingRepository::updateOrCreate(['name' => 'zarinpal_mode'], ['value' => $this->zarin_mode]);
        $this->settingRepository::updateOrCreate(['name' => 'zarinpal_logo'], ['value' => $this->zarin_logo]);
        $this->settingRepository::updateOrCreate(['name' => 'zarinpal_unit'], ['value' => $this->zarin_unit]);
        $this->settingRepository::updateOrCreate(['name' => 'payir_merchantId'], ['value' => trim($this->payir_merchantId)]);
        $this->settingRepository::updateOrCreate(['name' => 'payir_title'], ['value' => 'پی']);
        $this->settingRepository::updateOrCreate(['name' => 'payir_logo'], ['value' => $this->payir_logo]);
        $this->settingRepository::updateOrCreate(['name' => 'payir_unit'], ['value' => $this->payir_unit]);
        $this->settingRepository::updateOrCreate(['name' => 'idpay_logo'], ['value' => $this->idpay_logo]);
        $this->settingRepository::updateOrCreate(['name' => 'idpay_title'], ['value' => 'ای دی پی']);
        $this->settingRepository::updateOrCreate(['name' => 'idpay_merchantId'], ['value' => trim($this->idpay_merchantId)]);
        $this->settingRepository::updateOrCreate(['name' => 'idpay_sandbox'], ['value' => $this->idpay_sandbox]);
        $this->settingRepository::updateOrCreate(['name' => 'idpay_unit'], ['value' => $this->idpay_unit]);

        $this->settingRepository::updateOrCreate(['name' => 'autographs'], ['value' => json_encode($this->autographs)]);
        $this->settingRepository::updateOrCreate(['name' => 'copyRight'], ['value' => $this->copyRight]);
        $this->settingRepository::updateOrCreate(['name' => 'logo'], ['value' => $this->logo]);
        $this->settingRepository::updateOrCreate(['name' => 'title'], ['value' => $this->title]);
        $this->settingRepository::updateOrCreate(['name' => 'name'], ['value' => $this->name]);
        $this->settingRepository::updateOrCreate(['name' => 'seoDescription'], ['value' => $this->seoDescription]);
        $this->settingRepository::updateOrCreate(['name' => 'seoKeyword'], ['value' => $this->seoKeyword]);
        $this->settingRepository::updateOrCreate(['name' => 'registerGift'], ['value' => $this->registerGift]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }


    public function deleteAutograph($key)
    {
        unset($this->autographs[$key]);
    }

    public function addAutograph()
    {
        $this->autographs[] = '';
    }

    public function update_info()
    {
        $this->validate([
            'update_email' => ['required','email','max:240'],
            'update_phone' => ['required','size:11','string'],
            'name' => ['required', 'string','max:120'],
        ],[],[
            'update_email' => 'ایمیل',
            'update_phone' => 'شماره همراه',
            'name' => 'نام سایت',
        ]);
        if (
            $this->update_email != $this->settingRepository->getRow('update_email') ||
            $this->update_phone != $this->settingRepository->getRow('update_phone')
        ) {
            $message = "دریافت از";
            $message.= $this->name;
            $message.= " اطلاعات تماس :  ";
            $message.= " email : {$this->update_email} , ";
            $message.= " phone : {$this->update_phone} ";
            try {
                if (mail('rdezhhoot@gmail.com','درخخواست اطلاع رسالنی سیستم فست لرن',$message) ) {
                    $this->settingRepository::updateOrCreate(['name' => 'update_email'], ['value' => $this->update_email]);
                    $this->settingRepository::updateOrCreate(['name' => 'update_phone'], ['value' => $this->update_phone]);
                    $this->emitNotify('اطلاعات با موفقیت ثبت شد');
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
                $this->emitNotify('خطایی در هنگام ثبت اطلاعات رخ داده است.','warning');
            }
        }

    }
}
