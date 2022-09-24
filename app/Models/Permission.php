<?php

namespace App\Models;
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
            'samples' => 'نمونه سوالات'
        ];
    }

    public function getLabelAttribute()
    {
        $names = explode('_',$this->name);
        if (in_array(str_replace($names[0].'_','',$this->name),array_keys($this->lang()))){
            $action = $this->lang()[$names[0]];
            $model = $this->lang()[str_replace($names[0].'_','',$this->name)];
            return $action.' '.$model;
        }
        return  $this->name;
    }

}
