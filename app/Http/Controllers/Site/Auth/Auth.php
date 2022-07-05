<?php

namespace App\Http\Controllers\Site\Auth;

use App\Enums\UserEnum;
use App\Events\AuthenticationEvent;
use App\Events\RegisterEvent;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseComponent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth as Authentication;
use App\Mail\AuthenticationMail as AuthMailer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;


class Auth extends BaseComponent
{
    protected $queryString = ['action'];
    public $phone , $password  , $name  , $action = self::MODE_LOGIN , $email;
    public $logo , $authImage , $passwordLabel = 'رمز عبور';
    public bool $sms = false , $sent = false;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
    }

    public function mount()
    {
        if (!isset($this->action))
            $this->action = self::MODE_LOGIN;

        if ($this->action == self::MODE_LOGIN) $title = 'ورود';
        else $title = 'ثبت نام';

        $this->logo = $this->settingRepository->getRow('logo');
        $this->authImage = $this->settingRepository->getRow('authImage');
        SEOMeta::setTitle($this->settingRepository->getRow('title').' '.$title);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' '.$title);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' '.$title);
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').' '.$title);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
    }

    public function render()
    {
        return $this->action == self::MODE_LOGIN ?
            view('site.auth.login')->extends('site.layouts.site.site') :
            view('site.auth.register')->extends('site.layouts.site.site');
    }

    public function login()
    {
        if ($rateKey = rateLimiter(value:$this->phone))
        {
            $this->resetInputs();
            return
                $this->addError('phone', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
        }

        $this->resetErrorBag();
        $this->validate([
            'phone' => ['required','string','exists:users,phone'],
            'password' => ['required']
        ],[],[
            'phone' => 'شماره',
            'password' => 'رمز عبور',
        ]);
        $auth = false;
        $user = $this->userRepository->getUser('phone',"$this->phone");
        $user_otp = $user->otp;

        if ($user->status == UserEnum::CONFIRMED){
            if (Hash::check($this->password, $user->password) ||
                (!is_null($user->otp) && Hash::check($this->password, $user_otp) && $this->sms === true))
                $auth = true;
        } elseif ($user->status == UserEnum::NOT_CONFIRMED) {
            if (!is_null($user->otp) && Hash::check($this->password, $user_otp) && $this->sms === true)
                $auth = true;
            else return $this->addError('password','کد تایید یا شماره/ایمیل وارد شده اشتباه می باشد');
        } else return false;

        if ($auth) {
            Authentication::login($user,true);
            request()->session()->regenerate();
            $this->userRepository->update($user,['otp' => null]);
            RateLimiter::clear($rateKey);
            AuthenticationEvent::dispatch($user);

            return Authentication::user()->hasRole('admin') ?
                redirect()->intended(route('admin.dashboard')) :
                redirect()->intended(route('user.dashboard'));
        }
        return $this->addError('password','گذواژه یا شماره همراه اشتباه می باشد.');
    }

    private function resetInputs()
    {
        $this->reset(['phone', 'password']);
    }

    public function sendVerificationCode(): bool|MessageBag
    {
        $settingRepository = $this->settingRepository;
        $sendRepository =  $this->sendRepository;
        $userRepository =  $this->userRepository;

        if ($this->sent && $this->checkTimer())
            return $this->addError('phone','رمز یکبار مصرف قبلا برای شما ارسال شده است.');

        if (rateLimiter(value:$this->phone))
        {
            $this->resetInputs();
            return
                $this->addError('phone', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
        }

        $this->validate([
            'phone' => ['required','string','exists:users,phone'],
        ],[],[
            'phone' => 'شماره همراه ',
        ]);

        $rand = $this->generateCode();
        $user = $userRepository->getUser('phone',"$this->phone");
        app(OtpRepositoryInterface::class)->save($user,$rand);
        $ok = false;
        $auth_type = $settingRepository->getRow('auth_type');
        if ($auth_type == 'otp' ){
            try {
                $sendRepository->sendCode($rand,$this->phone);
                $this->passwordLabel = 'رمز ارسال شده را وارد نماید';
                $ok = true;
            } catch (Exception $e) {
                Log::error($e->getMessage());
                $this->addError('phone','خطا در هنگام ارسال رمز');
            }
        } elseif ($auth_type == 'email' || empty($auth_type)) {
            try {
                Mail::to($user->email)->send(new AuthMailer($user,$rand,UserEnum::AUTHENTICATE_EVENT));
                $this->passwordLabel = 'رمز ایمیل شده را وارد نماید';
                $ok = true;
            } catch (Exception $e) {
                Log::error($e->getMessage());
                $this->addError('phone','خطا در هنگام ارسال رمز');
            }
        } else return $this->addError('phone','خطا در هنگام ارسال رمز');

        if ($ok) {
            Session::put('timer', Carbon::make(now())->addSeconds(90));
            $this->setTimer();
            $this->sms = true;
            $this->sent = true;
        }
        return false;
    }

    public function signUp()
    {
        $this->sent = false;
        $this->validate([
            'name' => ['required','string','max:250'],
            'email' => ['required','string','email','unique:users,email','max:250'],
            'phone' => ['required','string','size:11','unique:users,phone'],
            'password' => ['required','min:'.($this->settingRepository->getRow('password_length') ?? 5),'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'],
        ],[],[
            'name' => 'نام کامل',
            'email' => 'ایمیل',
            'phone' => 'شماره همراه',
            'password' => 'رمز عبور',
        ]);
        $user = $this->userRepository->create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'status' => UserEnum::NOT_CONFIRMED,
            'ip' => request()->ip(),
        ]);
        $registerGift = $this->settingRepository->getRow('registerGift');
        if (!empty($registerGift) && is_numeric($registerGift) &&  $registerGift> 0)
            $user->deposit($this->settingRepository->getRow('registerGift'), ['description' => 'هدیه ثبت نام', 'from_admin'=> true]);

        $this->action = self::MODE_LOGIN;
        $this->sendVerificationCode();
        RegisterEvent::dispatch($user);
    }

    public function generateCode(): int
    {
        return mt_rand(12345,999998);
    }

    public function canSendAgain()
    {
        $this->sent = false;
    }

    public function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make(Session::get('timer')));
        return ($interval->format("%r") == "-");
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => Session::get('timer') ? Session::get('timer')->toDateTimeString() : '']);
    }

    public function checkSession()
    {
        if (!$this->checkTimer())
        {
            $this->sent = true;
            $this->setTimer();
        }
    }
}
