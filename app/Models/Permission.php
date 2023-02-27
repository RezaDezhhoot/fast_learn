<?php

namespace App\Models;

use App\Enums\StorageEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property mixed name
 * @method static insert(array $data)
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    protected $fillable = ['name','guard_name'];
    protected $attributes = [
        'guard_name' => 'web',
    ];

    public function lang()
    {
        return [
            'show' => 'نمایش',
            'edit' => 'ویرایش',
            'delete' => 'حذف',
            'dashboard' => 'داشبورد',
            'users' => 'کاربران',
            'roles' => 'نقش ها',
            'tasks' => 'وظایف',
            'categories' => 'دسته بندی ها',
            'articles' => 'مقالات',
            'payments' => 'پرداخت ها',
            'securities' => 'امنیت',
            'settings_base' => 'تنطیمات پایه',
            'settings_home' => 'تنطیمات صفحه اصلی',
            'settings_aboutUs' => 'تنطیمات درباره ما',
            'settings_contactUs' => 'تنطیمات ارتباط با ما',
            'settings_fag' => 'تنطیمات سوالات متداول ',
            'settings_sms' => 'تنطیمات sms ',
            'settings' => 'تنطیمات',
            'orders' => 'سفارش ها',
            'tickets' => 'تیکت ها',
            'notifications' => 'اعلان ها',
            'comments' => 'کامنت ها',
            'cancel' => 'لغو',
            'reductions' => 'کد های تخفیف',
            'courses'=>'دوره ها',
            'tags'=>'تگ ها',
            'transcripts'=>'کارنامه ها',
            'teachers'=>'مدرس ها',
            'certificates'=>'گواهینامه ها',
            'questions'=>'سوال ها',
            'quizzes'=>'امتحان ها',
            'organizations'=>'سازمان ها',
            'executives' => 'دستگاه های اجرایی',
            'events' => 'رویداد ها',
            'episodes' => 'درس ها',
            'contacts' => 'ارتباط با ما',
            'logs' => 'لاگ ها',
            'samples' => 'نمونه سوالات',
            'storages' => 'فضا های دخیره سازی',
            'teacher_requests' => 'درخواست های همکاری',
            'new_courses' => 'دوره های جدید',
            'checkouts' => 'تسویه حساب های مدرسین',
            'bank_accounts' => 'حساب های بانکی',
            'incoming_methods' => 'روش های محاسبه درامد',
            'jobs' => 'صف پردازش ها'
        ];
    }

    public function getLabelAttribute()
    {
        if (preg_match('/'.StorageEnum::PERMISSION_PREFIX."[0-9]/i",$this->name)) {
            $id = str_replace(StorageEnum::PERMISSION_PREFIX,'',$this->name);
            return Storage::withoutGlobalScope('available')->find($id)->name ?? $this->name;
        } else {
            $names = explode('_',$this->name);
            if (in_array(str_replace($names[0].'_','',$this->name),array_keys($this->lang()))){
                $action = $this->lang()[$names[0]];
                $model = $this->lang()[str_replace($names[0].'_','',$this->name)];
                return $action.' '.$model;
            }
        }
        return $this->name;
    }

}
