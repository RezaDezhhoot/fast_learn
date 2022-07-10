<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Validation\Rule;

class BaseSetting extends BaseComponent
{
    public $header , $name , $logo , $status , $title  , $copyRight  ,$storage ;
    public   $i = 1 , $registerGift , $notification  , $seoDescription , $seoKeyword , $footerText ;
    public $ftp_root , $ftp_ip , $ftp_username , $ftp_password , $ftp_port = 21 , $ftp_ssl = false , $ftp_available;

    public $s3_key , $s3_secret , $s3_region ,$s3_bucket , $s3_url , $s3_endpoint , $s3_use_path_style_endpoint , $s3_available;

    public $sftp_root , $sftp_available , $sftp_privateKey , $sftp_hostFingerprint , $sftp_maxTries , $sftp_passphrase , $sftp_useAgent , $sftp_host , $sftp_username , $sftp_password , $sftp_port = 22;

    public $faraz_apiKey , $faraz_password , $faraz_username , $faraz_line , $faraz_pattern , $faraz_var;

    public $gateway = [];

    public $zarin_merchantId , $zarin_mode , $zarin_logo , $payir_merchantId , $payir_logo , $idpay_merchantId , $idpay_sandbox , $idpay_logo;
    public $zarin_unit , $payir_unit , $idpay_unit;

    public $email_host , $email_username , $email_password;

    public $autographs = [];

    public $auth_type , $send_type;

    public $site_key , $secret_key;

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

        $this->email_host = $this->settingRepository->getRow('email_host');
        $this->email_username = $this->settingRepository->getRow('email_username');
        $this->email_password = $this->settingRepository->getRow('email_password');

        $this->faraz_apiKey = $this->settingRepository->getRow('faraz_apiKey');
        $this->faraz_password = $this->settingRepository->getRow('faraz_password');
        $this->faraz_username = $this->settingRepository->getRow('faraz_username');
        $this->faraz_line = $this->settingRepository->getRow('faraz_line');
        $this->faraz_pattern = $this->settingRepository->getRow('faraz_pattern');
        $this->faraz_var = $this->settingRepository->getRow('faraz_var');

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
        $this->storage = $this->settingRepository->getRow('storage') ?? 1;

        $this->sftp_root = $this->settingRepository->getRow('sftp_root');
        $this->sftp_privateKey = $this->settingRepository->getRow('sftp_privateKey');
        $this->sftp_hostFingerprint = $this->settingRepository->getRow('sftp_hostFingerprint');
        $this->sftp_maxTries = $this->settingRepository->getRow('sftp_maxTries');
        $this->sftp_port = $this->settingRepository->getRow('sftp_port') ?? 22;
        $this->sftp_passphrase = $this->settingRepository->getRow('sftp_passphrase');
        $this->sftp_host = $this->settingRepository->getRow('sftp_host');
        $this->sftp_username = $this->settingRepository->getRow('sftp_username');
        $this->sftp_password = $this->settingRepository->getRow('sftp_password');
        $this->sftp_useAgent = $this->settingRepository->getRow('sftp_useAgent') ?? false;
        $this->sftp_available = $this->settingRepository->getRow('sftp_available') ?? false;

        $this->ftp_ip = $this->settingRepository->getRow('ftp_ip');
        $this->ftp_root = $this->settingRepository->getRow('ftp_root');
        $this->ftp_username = $this->settingRepository->getRow('ftp_username');
        $this->ftp_password = $this->settingRepository->getRow('ftp_password');
        $this->ftp_port = $this->settingRepository->getRow('ftp_port') ?? 21;
        $this->ftp_ssl = $this->settingRepository->getRow('ftp_ssl');
        $this->ftp_available = $this->settingRepository->getRow('ftp_available') ?? false;

        $this->s3_key = $this->settingRepository->getRow('s3_key');
        $this->s3_secret = $this->settingRepository->getRow('s3_secret');
        $this->s3_region = $this->settingRepository->getRow('s3_region');
        $this->s3_bucket = $this->settingRepository->getRow('s3_bucket');
        $this->s3_url = $this->settingRepository->getRow('s3_url');
        $this->s3_endpoint = $this->settingRepository->getRow('s3_endpoint');
        $this->s3_use_path_style_endpoint = $this->settingRepository->getRow('s3_use_path_style_endpoint');
        $this->s3_available = $this->settingRepository->getRow('s3_available') ?? false;

        $this->logo = $this->settingRepository->getRow('logo');
        $this->title = $this->settingRepository->getRow('title');
        $this->name = $this->settingRepository->getRow('name');
        $this->registerGift = $this->settingRepository->getRow('registerGift');

        $this->seoDescription = $this->settingRepository->getRow('seoDescription');
        $this->seoKeyword = $this->settingRepository->getRow('seoKeyword');
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
                'storage' => ['integer','in:1,2,3,4'],
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

                'ftp_root' => [Rule::requiredIf(fn() => $this->storage == '2' || $this->ftp_available),'string','max:300'],
                'ftp_ip' => [Rule::requiredIf(fn() => $this->storage == '2' || $this->ftp_available),'string','max:300'],
                'ftp_username' => [Rule::requiredIf(fn() => $this->storage == '2' || $this->ftp_available),'string','max:1000'],
                'ftp_password' => [Rule::requiredIf(fn() => $this->storage == '2' || $this->ftp_available),'string','max:1000'],
                'ftp_port' => [Rule::requiredIf(fn() => $this->storage == '2' || $this->ftp_available),'max:1000'],
                'ftp_ssl' => ['boolean'],
                'ftp_available' => ['nullable','boolean'],

                's3_key' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_secret' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_region' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_bucket' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_url' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_endpoint' => [Rule::requiredIf(fn() => $this->storage == '3' || $this->s3_available),'string','max:1000'],
                's3_use_path_style_endpoint' => ['boolean'],
                's3_available' => ['nullable','boolean'],

                'sftp_root' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_privateKey' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_hostFingerprint' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_maxTries' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_port' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'max:1000'],
                'sftp_passphrase' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_host' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_username' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_password' => [Rule::requiredIf(fn() => $this->storage == '4' || $this->sftp_available),'string','max:1000'],
                'sftp_useAgent' => ['boolean'],
                'sftp_available' => ['nullable','boolean'],

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
                'storage' => 'فضای ابری',

                'ftp_root' => 'ftp root',
                'ftp_ip' => 'ftp ای پی',
                'ftp_username' => 'ftp نام کاربری',
                'ftp_password' => 'ftp رمزعبور',
                'ftp_port' => 'ftp پورت',
                'ftp_ssl' => 'ftp ssl',
                'ftp_available' => 'فعال سازی',

                's3_key' => 's3 key',
                's3_secret' => 's3 secret',
                's3_region' => 's3 region',
                's3_bucket' => 's3 bucket',
                's3_url' => 's3 url',
                's3_endpoint' => 's3 endpoint',
                's3_use_path_style_endpoint' => 's3 use path style endpoint',
                's3_available' => 'فعال سازی',

                'sftp_root' => 'sftp root',
                'sftp_privateKey' => 'sftp private key',
                'sftp_hostFingerprint' => 'sftp host fingerprint',
                'sftp_maxTries' => 'sftp max tries',
                'sftp_port' => 'sftp port',
                'sftp_passphrase' => 'sftp passphrase',
                'sftp_host' => 'sftp host',
                'sftp_username' => 'sftp username',
                'sftp_password' => 'sftp password',
                'sftp_useAgent' => 'sftp use agent',
                'sftp_available' => 'فعال سازی',

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

        $this->settingRepository::updateOrCreate(['name' => 'sftp_root'], ['value' => trim($this->sftp_root)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_privateKey'], ['value' => trim($this->sftp_privateKey)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_hostFingerprint'], ['value' => trim($this->sftp_hostFingerprint)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_maxTries'], ['value' => $this->sftp_maxTries]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_port'], ['value' => $this->sftp_port]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_passphrase'], ['value' => $this->sftp_passphrase]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_host'], ['value' => trim($this->sftp_host)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_username'], ['value' => trim($this->sftp_username)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_password'], ['value' => trim($this->sftp_password)]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_useAgent'], ['value' => $this->sftp_useAgent]);
        $this->settingRepository::updateOrCreate(['name' => 'sftp_available'], ['value' => $this->sftp_available]);

        $this->settingRepository::updateOrCreate(['name' => 's3_key'], ['value' => trim($this->s3_key)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_secret'], ['value' => trim($this->s3_secret)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_region'], ['value' => trim($this->s3_region)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_bucket'], ['value' => trim($this->s3_bucket)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_url'], ['value' => trim($this->s3_url)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_endpoint'], ['value' => trim($this->s3_endpoint)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_use_path_style_endpoint'], ['value' => trim($this->s3_use_path_style_endpoint)]);
        $this->settingRepository::updateOrCreate(['name' => 's3_available'], ['value' => trim($this->s3_available)]);

        $this->settingRepository::updateOrCreate(['name' => 'autographs'], ['value' => json_encode($this->autographs)]);
        $this->settingRepository::updateOrCreate(['name' => 'copyRight'], ['value' => $this->copyRight]);
        $this->settingRepository::updateOrCreate(['name' => 'logo'], ['value' => $this->logo]);
        $this->settingRepository::updateOrCreate(['name' => 'title'], ['value' => $this->title]);
        $this->settingRepository::updateOrCreate(['name' => 'name'], ['value' => $this->name]);
        $this->settingRepository::updateOrCreate(['name' => 'seoDescription'], ['value' => $this->seoDescription]);
        $this->settingRepository::updateOrCreate(['name' => 'seoKeyword'], ['value' => $this->seoKeyword]);
        $this->settingRepository::updateOrCreate(['name' => 'registerGift'], ['value' => $this->registerGift]);
        $this->settingRepository::updateOrCreate(['name' => 'storage'], ['value' => $this->storage]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_root'], ['value' => trim($this->ftp_root)]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_ip'], ['value' => trim($this->ftp_ip)]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_username'], ['value' => trim($this->ftp_username)]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_password'], ['value' => trim($this->ftp_password)]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_ssl'], ['value' => $this->ftp_ssl]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_port'], ['value' => $this->ftp_port]);
        $this->settingRepository::updateOrCreate(['name' => 'ftp_available'], ['value' => $this->ftp_available]);

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
}
