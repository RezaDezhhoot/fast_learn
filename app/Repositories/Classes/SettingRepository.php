<?php


namespace App\Repositories\Classes;

use App\Models\Article;
use App\Models\Category;
use App\Models\Course;
use App\Models\Organ;
use App\Models\Setting;
use App\Models\Teacher;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public static function variables()
    {
        return [
            'orders' => [
                '{order_tracking_code}' => 'کد پیگیری',
                '{order_total_price}' => 'مبلغ پرداهت شده',
                '{order_courses}' => 'دروه های خریداری شده',
                '{order_name}' => 'نام کامل خریدار',
            ],
            'tickets' => [
                '{ticket_subject}' => 'موضوع تیکت',
                '{ticket_priority}' => 'اولویت تیکت',
                '{ticket_name}' => 'نام کامل کاربر',
            ],
            'auth' => [
                '{auth_name}' => 'نام کامل کاربر',
                '{auth_status}' => 'وضعیت  کاربر',
            ],
            'exams' => [
                '{exam_name}' => 'نام ازمون',
                '{exam_score}' => 'نمره دریافت شده',
                '{exam_min_score}' => 'حداقل نمره',
                '{exam_max_score}' => 'حداکثر نمره',
            ],
            'teacher' => [
                '{teacher_name}' => 'نام کاربر',
                '{request_id}' => 'شماره درخواست'
            ],
            'new_course' => [
                '{title}' => 'عنوان دوره',
                '{user_name}' => 'نام مدرس',
                '{level}' => 'سطح دوره',
            ]
        ];
    }

    public function getRow($name , $default = null)
    {
        return Setting::getSingleRow($name , $default);
    }

    public function getSubjects($name, $default = [])
    {
        return Setting::getSingleRow($name , $default);
    }

    public function getAdminFag($name)
    {
//        return
    }

    public function getFagList()
    {
        return collect(Setting::where('name','question')->pluck('value')->toArray())->sortBy('order');
    }

    /**
     * @return mixed
     */
    public static function getProvince()
    {
        return Setting::getProvince();
    }

    /**
     * @param $province
     * @return mixed
     */
    public static function getCity($province)
    {
        return Setting::getCity()[$province];
    }

    public static function getCities()
    {
        return Setting::getCity();
        // TODO: Implement getCities() method.
    }

    public static function updateOrCreate(array $key, array $value)
    {
        return Setting::updateOrCreate($key, $value);
    }

    public function find($id)
    {
        return Setting::findOrFail($id);
    }

    public function delete(Setting $setting)
    {
        return $setting->delete();
    }

    public function newSettingObject()
    {
        return new Setting();
    }

    public function save(Setting $setting)
    {
        $setting->save();
        return $setting;
    }

    public function codes()
    {
        return Setting::codes();
    }

    public function getAdminLaw($name)
    {
        return Setting::where('name',$name)->get()->toArray() ?? [];
    }

    public static function models()
    {
        return [
            'categories' => new Category(),
            'courses' => new Course(),
            'articles' => new Article(),
            'teachers' => new Teacher(),
            'organs' => new Organ()
        ];
    }
}
