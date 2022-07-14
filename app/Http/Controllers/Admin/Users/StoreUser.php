<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\NotificationEnum;
use App\Enums\UserEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Rules\ValidNationCode;
use Bavix\Wallet\Exceptions\BalanceIsEmpty;
use Bavix\Wallet\Exceptions\InsufficientFunds;
use Carbon\Carbon;

class StoreUser extends BaseComponent
{
    public $user  ,$name, $header , $userRole = [] , $password  , $code_id   , $avatar , $image;
    public $phone , $province , $city  , $status , $email , $actionWallet , $editWallet , $sendMessage , $subjectMessage,
        $statusMessage , $result , $walletMessage   , $userWallet , $father_name , $birthday , $password_lgh ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->roleRepository = app(RoleRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->notificationRepository = app(NotificationRepositoryInterface::class);
        $this->userDetailRepository = app(UserDetailRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_users');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->header = 'کاربر شماره '.$id;
            $this->user = $this->userRepository->find($id);
            $this->name = $this->user->name;
            $this->phone = $this->user->phone;
            $this->status = $this->user->status;
            $this->email = $this->user->email;
            $this->image = $this->user->image;
            $this->province = $this->user->details->province ?? null;
            $this->city = $this->user->details->city ?? null;
            $this->code_id = $this->user->details->code_id ?? null;
            $this->avatar = $this->user->details->avatar ?? null;
            $this->father_name = $this->user->details->father_name ?? null;
            $this->birthday = $this->user->details->birthday ?? null;
            $this->userRole = $this->user->roles()->pluck('name','id')->toArray();
            $this->userWallet = $this->userRepository->walletTransactions($this->user);
            $this->result = $this->user->alerts;
        } elseif ($this->mode == self::CREATE_MODE)
            $this->header = 'کاربر جدید';
        else abort(404);

        $this->data['status'] = UserEnum::getStatus();
        $this->data['role'] = $this->roleRepository->whereNotIn('name', ['administrator']);
        $this->data['action'] = [
            'deposit' => 'واریز',
            'withdraw' => 'برداشت',
        ];
        $this->data['subjectMessage'] = NotificationEnum::getSubject();
        $this->data['province'] = $this->settingRepository::getProvince();
        $this->password_lgh = $this->settingRepository->getRow('password_length') ?? 5;
    }

    public function store()
    {
        $this->authorizing('edit_users');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDataBase($this->user);
        else {
            $this->saveInDataBase($this->userRepository->newUserObject());
            $this->reset([
                'name','phone','status','email','image',
                'province','city','code_id','father_name','birthday','avatar','password',
            ]);
        }
    }

    public function saveInDataBase($model)
    {
        $this->birthday = $this->emptyToNull($this->birthday);
        if (!is_null($this->birthday)) {
            if (
                preg_match("/^[0-9]{4}-([1-9]|1[0-2])-([1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday) ||
                preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$this->birthday)
            )
                $this->birthday = Carbon::make($this->birthday)->format('Y-m-d');
            else return $this->addError('birthday','تاریخ تولد با الگوی Y-m-d مطابقت ندارد.');
        }

        $fields = [
            'name' => ['required', 'string','max:65'],
            'phone' => ['required', 'size:11' , 'unique:users,phone,'. ($this->user->id ?? 0)],
            'status' => ['required','in:'.implode(',',array_keys(UserEnum::getStatus()))],
            'email' => ['required','email','max:200','unique:users,email,'. ($this->user->id ?? 0)],
            'image' => ['nullable','string','max:255'],
            'province' => ['nullable','string','in:'.implode(',',array_keys($this->data['province']))],
            'city' => ['nullable','string','in:'.implode(',',array_keys($this->data['city']))],
            'code_id' => ['nullable',new ValidNationCode()],
            'father_name' => ['nullable','string','max:250'],
            'birthday' => ['nullable','string','max:255'],
            'avatar' => ['nullable','string','max:255'],
        ];
        $messages = [
            'name' => 'نام ',
            'phone' => 'شماره همراه',
            'status' => 'وضعیت',
            'email' => 'ایمیل',
            'image' => 'تصویر',
            'province' => 'استان',
            'city' => 'شهر',
            'code_id' => 'شماره ملی',
            'father_name' => 'نام پدر',
            'birthday' => 'بیوگرافی',
            'avatar' => 'تصویر رسمی',
        ];

        if ($this->mode == self::CREATE_MODE)
        {
            $fields['password'] = ['required','min:'.$this->password_lgh,'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/'];
            $messages['password'] = 'گذرواژه';
        }

        $this->validate($fields,[],$messages);

        $model->name = $this->name;
        $model->phone = $this->phone;
        $model->status = $this->status;
        $model->email = $this->email;
        $model->image = $this->image;
        $model->ip = uniqid();
        if ($this->mode == self::CREATE_MODE)
            $model->password = $this->password;

        $user = $this->userRepository->save($model);

        $this->userDetailRepository->updateOrCreate([
            'user_id' => $user->id
        ],[
            'province' => $this->province,
            'city' => $this->city,
            'code_id' => $this->code_id,
            'father_name' => $this->father_name,
            'birthday' => $this->birthday,
            'avatar' => $this->avatar,
        ]);
        if ((auth()->user()->hasRole('super_admin') && !$model->hasRole('administrator')) || auth()->user()->hasRole('administrator'))
        {
            $this->userRepository->syncRoles($model,$this->userRole);
            if (in_array('teacher',$this->userRole)) {
                $this->teacherRepository->updateOrCreate(['user_id'=>$model->id],['deleted_at'=>null]);
            } else {
                $this->teacherRepository->delete($model->id);
            }
        }

        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function wallet()
    {
        $this->authorizing('edit_users');
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->validate([
                'actionWallet' => ['required' ,'in:deposit,withdraw'],
                'editWallet' => ['required','numeric','between:0,999999999.9999'],
                'walletMessage' => ['nullable','string','max:150'],
            ] , [] ,[
                'actionWallet' => 'عملیات',
                'editWallet' => 'مبلغ',
                'walletMessage' => 'متن پیام',
            ]);
            if ($this->actionWallet == 'deposit') {
                $this->user->deposit($this->editWallet, ['description' => $this->walletMessage, 'from_admin'=> true]);
            } else {
                try {
                    $this->user->forceWithdraw($this->editWallet, ['description' => $this->walletMessage, 'from_admin'=> true]);
                } catch (BalanceIsEmpty | InsufficientFunds $exception) {
                    $this->addError('walletAmount', $exception->getMessage());
                }
            }
            $this->userWallet = $this->userRepository->walletTransactions($this->user);
            $this->reset(['actionWallet', 'editWallet', 'walletMessage']);
            $this->emitNotify('کیف پول کاربر با موفقیت ویرایش شد');
        }
    }

    public function sendMessage()
    {
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->validate([
                'sendMessage' => ['required' ,' string','max:255'],
                'subjectMessage' => ['string','required','in:'.implode(',',array_keys(NotificationEnum::getSubject()))],
            ] , [] ,[
                'sendMessage' => 'متن پیام',
                'subjectMessage' => 'موضوع',
            ]);

            $notification = [
                'subject' => $this->subjectMessage,
                'content' =>  $this->sendMessage,
                'type' => NotificationEnum::PRIVATE,
                'user_id' => $this->user->id,
                'model' => $this->subjectMessage,
                'model_id' => $this->user->id
            ];
            $notification = $this->notificationRepository->create($notification);
            $this->result->push($notification);
            $this->reset(['sendMessage','subjectMessage']);
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        }
    }

    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && !empty($this->province)){

            $this->data['city'] = $this->settingRepository->getCity($this->province);
        }

        return view('admin.users.store-user')->extends('admin.layouts.admin');
    }

}
