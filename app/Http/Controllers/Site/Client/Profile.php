<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use App\Rules\ValidNationCode;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;

class Profile extends BaseComponent
{
    use WithFileUploads;

    public mixed $user;
    public bool $userDetails = false;
    public $name , $email , $image , $password;
    public $code_id  , $father_name , $birthday , $province , $city ;
    public $file , $gateways = [] , $price , $gateway , $tab;
    public $token ;
    public $isSuccessful, $message , $organization , $executive;

    public $teacher , $teacher_title , $teacher_content;

    protected $queryString = ['tab','token'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->userDetailRepository = app(UserDetailRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->organizationRepository = app(OrganizationRepositoryInterface::class);
        $this->executiveRepository = app(ExecutiveRepositoryInterface::class);
        $this->disk = getDisk('public');
    }

    public function mount($gateway = null)
    {
        if (!request()->exists('tab'))
            $this->tab = 'profile';

        if (request()->exists('id'))
            $this->token =request()->id;
        elseif (request()->exists('Authority'))
            $this->token = request()->Authority;

        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->user = auth()->user();
        $this->userDetails = !empty($this->user->details);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->image = $this->user->image;

        // if (Auth::user()->hasRole('teacher') && $this->teacher = Auth::user()->teacher){
        //     $this->teacher_title = $this->teacher->sub_title;
        //     $this->teacher_content = $this->teacher->body;
        // }

        if ($this->userDetails) {
            $this->code_id = $this->user->details->code_id;
            $this->father_name = $this->user->details->father_name;
            $this->birthday = $this->user->details->birthday;
            $this->province = $this->user->details->province;
            $this->city = $this->user->details->city;
            $this->organization = $this->user->details->organization_id;
            $this->executive = $this->user->details->executive_id;
        }
        $this->data['province'] = $this->settingRepository::getProvince();
        $gateways = $this->settingRepository->getRow('gateway',[]);
        foreach ($gateways as $key => $item)
        {
            if ($key == 0)
                $this->gateway = $item;

            $this->gateways[$item] = [
                'merchantId' => $this->settingRepository->getRow("{$item}_merchantId"),
                'title' => $this->settingRepository->getRow("{$item}_title"),
                'logo' => $this->settingRepository->getRow("{$item}_logo"),
                'sandbox' => (bool)$this->settingRepository->getRow("{$item}_sandbox") ?? null,
                'mode' => $this->settingRepository->getRow("{$item}_mode") ?? null,
                'unit' => (int)$this->settingRepository->getRow("{$item}_unit") ?? 1,
            ];
        }

        if (isset($this->token)) {
            $payment = $this->paymentReporitory->get([ ['payment_token', $this->token] ]);
            $result = $this->paymentReporitory->verify(
                $payment->amount*$this->gateways[$gateway]['unit'],
                $gateway,
                $this->gateways[$gateway],
                $this->token,
                function($payment = null,$amount = null) {
                    $this->verifyCallback($payment);
                    $this->deposit($amount);
                }
            );
            if (!$result){
                $this->isSuccessful = false;
                $this->message = 'پرداخت ناموفق بود';
            } else {
                $this->isSuccessful = true;
                $this->message = 'پرداخت با موفقیت انجام شد ';
            }
            $this->reset(['token']);
        }
    }

    public function render()
    {
        $this->data['organs'] = $this->organizationRepository->get(parent:true);
        $this->data['executives'] = $this->executiveRepository->get(parent:true);
        $this->data['city'] = [];
        if (isset($this->province) && in_array($this->province,array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);


        return view('site.client.profile',[
                'max_file_size' => !empty($this->settingRepository->getRow('max_profile_image_size')) ? $this->settingRepository->getRow('max_profile_image_size')  : 2048
            ]
        )->extends('site.layouts.client.client');
    }

    public function storeProfile()
    {
        $fields = [
            'name' => ['required', 'string','max:150'],
            'email' => ['required','email','max:255' , 'unique:users,email,'. ($this->user->id ?? 0)],
            'file' => ['nullable','image','mimes:jpg,jpeg,png,PNG,JPG,JPEG','max:'.($this->settingRepository->getRow('max_profile_image_size') ?? 2048)],
        ];
        $messages = [
            'name' => 'نام ',
            'email' => 'ایمیل',
            'file' => 'تصویر پروفایل',
        ];
        if (isset($this->password))
        {
            $fields['password'] = ['required','min:'.($this->settingRepository->getRow('password_length') ?? 5),'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'];
            $messages['password'] = 'گذرواژه';
        }

        $this->validate($fields,[],$messages);
        $this->uploadFile();
        if (!is_null($this->file)) {
            $oldFile = str_replace('storage','',$this->user->image);
            if (!is_null($this->user->image) && $this->disk->exists($oldFile))
                $this->disk->delete($oldFile);

            $this->user->image = 'storage/'.$this->disk->put('profiles',$this->file);
            unset($this->file);
        }

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        if (isset($this->password))
            $this->user->password = $this->password;

        $this->userRepository->save($this->user);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function storeDetails()
    {
        if (
            preg_match("/^[0-9]{4}-([1-9]|1[0-2])-([1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday) ||
            preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday)
        )
            $this->birthday = Carbon::make($this->birthday)->format('Y-m-d');
        else return $this->addError('birthday','تاریخ تولد با الگوی Y-m-d مطابقت ندارد.');

        $fields = [
            'code_id' => ['required',new ValidNationCode(),'unique:user_details,code_id,'.($this->user->details->id ?? 0)],
            'father_name' => ['required','string','max:70'],
            'birthday' => ['required'],
            'province' => ['required','in:'.implode(',',array_keys($this->data['province']))],
            'city' => ['required','in:'.implode(',',array_keys($this->data['city']))],
            'organization' => ['nullable','in:'.implode(',', array_value_recursive('id',$this->data['organs'])  )],
            'executive' => ['nullable','in:'.implode(',', array_value_recursive('id',$this->data['executives'])  )],
        ];
        $messages = [
            'code_id' => 'کد ملی',
            'father_name' => 'نام پدر',
            'birthday' => 'تاریخ تولد',
            'province' => 'استان',
            'city' => 'شهر',
            'organization' => 'سازمان',
            'executive' => 'دستگاه اجرایی'
        ];

        $this->validate($fields,[],$messages);

        $this->userDetailRepository->updateOrCreate(['user_id' => $this->user->id],[
            'code_id' => $this->code_id,
            'father_name' => $this->father_name,
            'birthday' => $this->birthday,
            'province' => $this->province,
            'city' => $this->city,
            'organization_id' => $this->organization,
            'executive_id' => $this->executive,
        ]);

        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    // public function storeTeacher()
    // {
    //     $this->validate([
    //         'teacher_title' => ['required','max:70'],
    //         'teacher_content' => ['required','string','max:12500'],
    //     ],[],[
    //         'teacher_title' => 'عنوان',
    //         'teacher_content' => 'متن',
    //     ]);
    //     $this->teacher->sub_title  = $this->teacher_title;
    //     $this->teacher->body = $this->teacher_content;
    //     $this->teacherRepository->save($this->teacher);
    //     return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    // }

    public function uploadFile()
    {
        // upon form submit, this function till fill your progress bar
    }

    public function payment()
    {
        $this->validate([
            'price' => ['required','integer','between:1000,10000000'],
            'gateway' => ['required','in:'.implode(',',app(SettingRepositoryInterface::class)->getRow('gateway',[]))]
        ],[] , [
            'price' => 'مبلغ',
            'gateway' => 'درگاه',
        ]);

        if ($error = $this->paymentReporitory->pay(
            amount: $this->price*$this->gateways[$this->gateway]['unit'],
            gateway: $this->gateway,
            config: $this->gateways[$this->gateway],
            callbackUrl: route('user.profile',[$this->gateway,'tab'=>'wallet']),
            callbackFunction: fn($gateway = null,$transactionId = null) => $this->payCallback($gateway,$transactionId)
        )) $this->addError('gateway',$error);
    }

    private function payCallback($gateway = null,$transactionId = null)
    {
        return DB::transaction(function () use ($gateway, $transactionId) {
            try {
                app(PaymentRepositoryInterface::class)->create(auth()->user(),[
                    'amount' => $this->price,
                    'payment_gateway' => $gateway,
                    'payment_token' => $transactionId,
                    'model_type' => PaymentEnum::user(),
                    'model_id' => auth()->id(),
                    'call_back_url' => '',
                    'ip' => request()->ip()
                ]);
            } catch (Exception $e) {
                $this->addError('gateway','خطا در هنگام پرداخت');
            }
        });
    }

    private function verifyCallback( $payment = null , $price = null)
    {
        $paymentRepository = app(PaymentRepositoryInterface::class);
        if (!is_null($payment) && empty($paymentRepository->get([['payment_ref', $payment->getReferenceId()]])) ) {
            $paymentRepository->update([
                'payment_ref' => $payment->getReferenceId(),
                'status_code' => '100',
                'status_message' => 'پرداخت با موفقیت انجام شد',
            ],[['payment_token', $this->token]]);
        }
    }

    private function deposit($price = null)
    {
        if (!is_null($price))
            auth()->user()->deposit($price, ['description' => 'خرید شارژ', 'from_admin'=> true]);
    }

    public function updatedFile()
    {
        $this->resetErrorBag();
    }
}
