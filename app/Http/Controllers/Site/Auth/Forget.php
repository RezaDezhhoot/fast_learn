<?php

namespace App\Http\Controllers\Site\Auth;

use App\Enums\NotificationEnum;
use App\Http\Controllers\BaseComponent;
use App\Mail\AuthenticationMail as AuthMailer;
use App\Models\Token;
use App\Models\User;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class Forget extends BaseComponent
{
    protected $queryString = ['action'];
    public $phone, $password, $action = self::FORGET_MODE, $email;
    public $logo, $passwordLabel = 'رمز عبور';
    public bool $sms = false, $sent = false;

    public $recaptcha;

    public $forget = false , $password_confirmation, $code, $auth_type;

    private $verify = false ;

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
            $this->action = self::FORGET_MODE;

        $title = 'فراموشی رمز';

        $this->logo = $this->settingRepository->getRow('logo');
        SEOMeta::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword', []));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title') . ' ' . $title);
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->settingRepository->getRow('forget') || abort(404);
        $this->auth_type = $this->settingRepository->getRow('auth_type') ?? 'none';
    }

    public function render()
    {
        if (!$this->phone) {
            $this->action = self::FORGET_MODE;
        }
        return view('site.auth.forget')->extends('site.layouts.site.site');
    }

    public function generateCode(): int
    {
        return mt_rand(12345, 999998);
    }

    public function canSendAgain()
    {
        $this->sent = false;
    }

    public function forget()
    {
        if ($rateKey = rateLimiter(value: 'forget', max_tries: 5)) {
            $this->resetInputs();
            return
                $this->addError('phone', 'زیادی تلاش کردید. لطفا پس از مدتی دوباره تلاش کنید.');
        }

        $this->resetErrorBag();

        $this->validate([
            'phone' => ['required', 'string', 'max:11', 'exists:users,phone'],
            'recaptcha' => [new ReCaptchaRule()]
        ], [], [
            'phone' => 'شماره همراه',
            'recaptcha' => 'فیلد امنیتی'
        ]);
        if ($this->sendVerificationCode()) {
            $this->emit('removeRecaptcha');
            $this->action = self::VERIFY_MODE;
        } else {
            $this->addError('phone','خظا در ارسال رمز یکبار مصرف');
        }
    }

    public function verify()
    {
        $this->validate([
            'phone' => ['required', 'string', 'max:11', 'exists:users,phone'],
            'code' => ['required','integer']
        ], [], [
            'phone' => 'شماره همراه',
            'code' => 'کد تایید'
        ]);

        if ($token = Token::query()->where([
            ['phone',$this->phone],
            ['verified',false],
            ['expires_at','>=',now()]
        ])->first()) {
            if (Hash::check($this->code, $token->value)) {
                $token->update(['verified' => true]);
                $this->action = self::RESET_MODE;
            } else {
                return $this->addError('code','کد تایید یا شماره وارد شده اشتباه می باشد');
            }
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'phone' => ['required', 'string', 'max:11', 'exists:users,phone'],
            'password' => ['required','string','confirmed','min:6']
        ], [], [
            'phone' => 'شماره همراه',
            'password' => 'رمز عبور'
        ]);

        if ($token = Token::query()->where([
            ['phone',$this->phone],
            ['verified',true],
            ['expires_at','>=',now()->subMinutes(10)]
        ])->first()) {
            try {
                DB::beginTransaction();
                User::query()->where('phone',$this->phone)
                    ->update(['password' => $this->password]);
                $token->delete();
                $this->emitNotify('رمز عبور شما با موفقیت ویرایش شد');
                $this->redirect(route('auth'));
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                report($e);
                $this->emitNotify('خظا در هنگام ویرایش رمز','warning');
            }
        }
    }

    public function sendVerificationCode($property = 'phone' , $action = 'forget'): bool|MessageBag
    {
        $userRepository =  $this->userRepository;
        if ($this->sent && $this->checkTimer()) {
            $this->addError($property,'رمز یکبار مصرف قبلا برای شما ارسال شده است.');
            return false;
        }

        $rand = $this->generateCode();
        $user = $userRepository->getUser('phone',$this->{$property});
        app(OtpRepositoryInterface::class)->save($user,$rand);

        return $this->sendOTP($property,$user,$rand,$action);
    }

    private function sendOTP($property,$user,$code , $action)
    {
        $sendRepository =  $this->sendRepository;
        $ok = false;
        try {
            if ($this->auth_type == NotificationEnum::SMS_METHOD){
                $sendRepository->sendCode($code,$this->phone);
                $ok = true;
            } elseif ($this->auth_type == NotificationEnum::EMAIL_METHOD) {
                $sendRepository->sendEmail(new AuthMailer($user,$code),$user->email);
                $ok = true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->addError("$property",'خطا در هنگام ارسال رمز');
        }

        if ($ok) {
            Session::put('timer', Carbon::make(now())->addSeconds(90));
            $this->setTimer();
            $this->sms = true;
            $this->sent = true;
        }

        return $ok;
    }

    public function checkTimer(): bool
    {
        $interval = Carbon::make(now())->diff(Carbon::make(Session::get('timer')));
        return ((int)$interval->format("%r%s") > 0);
    }

    public function checkSession()
    {
        if ($this->checkTimer())
        {
            $this->sent = true;
            $this->setTimer();
        }
    }

    private function resetInputs()
    {
        $this->reset(['phone', 'password']);
    }

    public function setTimer()
    {
        $this->emit('timer',['data' => Session::get('timer') ? Session::get('timer')->toDateTimeString() : '' ]);
    }
}
