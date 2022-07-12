<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $name)
 * @method static updateOrCreate(array $key, array $value)
 * @method static findOrFail($id)
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['name','value'];

    public static function getSingleRow($name, $default = '')
    {
        return Setting::where('name', $name)->first()->value ?? $default;
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = str_replace(env('APP_URL') . '/', '', $value);
    }

    public function getValueAttribute($value)
    {
        $data = json_decode($value, true);
        return is_array($data) ? $data : $value;
    }

    public static function getProvince()
    {
        return  [
            'Alborz' => 'البز',
            'Ardabil' => 'ادربیل',
            'Azerbaijan East' => 'اذربایجان شرقی',
            'Azerbaijan West' => 'اذربایجان غربی',
            'Bushehr' => 'بوشر',
            'Chahar Mahaal and Bakhtiari' => 'چهار محال و بختیاری',
            'Fars' => 'فارس',
            'Gilan' => 'گیلان',
            'Golestan' => 'گلستان',
            'Hamadan' => 'گرگان',
            'Hormozgān' => 'هرمزگان',
            'Ilam' => 'ایلام',
            'Isfahan' => 'اصفهان',
            'Kerman' => 'کرمان',
            'Kermanshah' => 'کرمانشاه',
            'Khorasan North' => 'خراسان شمالی',
            'Khorasan Razavi' => 'خراسان رضوی',
            'Khorasan South' => 'خراسان جنوبی',
            'Khuzestan' => 'خوزستان',
            'Kohgiluyeh and Boyer-Ahmad' => 'کهگیلویه و بویر احمد',
            'Kurdistan' => 'کردستان',
            'Lorestan' => 'لرستان',
            'Markazi' => 'مرکزی',
            'Mazandaran' => 'مازندران',
            'Qazvin' => 'قزوین',
            'Qom' => 'قم',
            'Semnan' => 'سمنان',
            'Sistan and Baluchestan' => 'سیستان و بلوچستان',
            'Tehran' => 'تهران',
            'Yazd' => 'یزد',
            'Zanjan' => 'زنجان',
        ];
    }

    public static function getCity()
    {
        return [
            'Alborz' => [
                'Karaj' => 'کرج',
                'Hashtgerd' => 'هشتگرد',
                'Nazar Abad' => 'نظرآباد',
                'Mohammad Shahr' => 'محمدشهر',
            ],
            'Ardabil' => [
                'Ardabil' => 'اردبیل',
                'Pars Abad' => 'پارس‌آباد',
                'Meshgin Shahr' => 'مشگین‌شهر',
                'KhalKhal' => 'خلخال',
            ],
            'Azerbaijan East' => [
                'Tabriz' => 'تبریز',
                'Maraghe' => 'مراغه',
                'Marand' => 'مرند',
                'Myane' => 'میانه',
            ],
            'Azerbaijan, West' => [
                'Orumie' => 'ارومیه',
                'Khouy' => 'خوی',
                'Myandoab' => 'میاندوآب',
                'Mehabad' => 'مهاباد',
            ],
            'Bushehr' => [
                'Bushehr' => 'بوشهر',
                'Barazjan' => 'برازجان',
                'Genaveh' => 'گناوه',
                'Khormoj' => 'خورموج',
            ],
            'Chahar Mahaal and Bakhtiari' => [
                'Shar Kord' => 'شهرکرد',
                'Brojen' => 'بروجن',
                'Farohk Shahr' => 'فرخ‌شهر',
                'Farsan' => 'فارسان',
            ],
            'Fars' => [
                'Shiraz' => 'شیراز',
                'Kazeroon' => 'کازرون',
                'Jahram' => 'جهرم',
                'Meroodasht' => 'مرودشت',
            ],
            'Gilan' => [
                'Rasht' => 'رشت',
                'Bandar Anzali' => 'بندر انزلی',
                'Lahijan' => 'لاهیجان',
                'Langrood' => 'لنگرود',
            ],
            'Golestan' => [
                'Gorgan' => 'گرگان',
                'Gonbad Kavoos' => 'گنبد کاووس',
            ],
            'Hamadan' => [
                'Hamadan' => 'همدان',
                'Malayer' => 'ملایر',
                'Nahavand' => 'نهاوند',
            ],
            'Hormozgān' => [
                'Bandarabas' => 'بندرعباس',
                'Minab' => 'میناب',
            ],
            'Ilam' => [
                'Ilam' => 'ایلام',
                'Ivan' => 'ایوان',
            ],
            'Isfahan' => [
                'Isfahan' => 'اصفهان',
                'Kashan' => 'کاشان',
                'Khomeini Shahr' => 'خمینی‌شهر',
                'Najaf Abad' => 'نجف‌آباد',
            ],
            'Kerman' => [
                'Kerman' => 'کرمان',
                'Sirjan' => 'سیرجان',
                'Rafsanjan' => 'رفسنجان',
            ],
            'Kermanshah' => [
                'Kermanshah' => 'کرمانشاه',
                'Islam Abad' => 'اسلام‌آباد',
            ],
            'Khorasan North' => [
                'Bojnourd' => 'بجنورد',
                'Shirvan' => 'شیروان',
                'Isfarayen' => 'اسفراین',
                'Garmeh Jajarm' => 'گرمه جاجرم',
            ],
            'Khorasan Razavi' => [
                'Mashhad' => 'مشهد',
                'Sbzevar' => 'سبزوار',
                'Neyshaboor' => 'نیشابور',
            ],
            'Khorasan South' => [
                'Birjand' => 'بیرجند',
                'Qaeen' => 'قائن',
                'Ferdos' => 'فردوس',
            ],
            'Khuzestan' => [
                'Ahvaz' => 'اهواز',
                'Dezful' => 'دزفول',
                'Abadan' => 'آبادان',
                'Khorram Shahr' => 'خرمشهر',
            ],
            'Kohgiluyeh and Boyer-Ahmad' => [
                'Yasooj' => 'یاسوج',
                'Dehdasht' => 'دهدشت',
            ],
            'Kurdistan' => [
                'Sanandaj' => 'سنندج',
                'Marivan' => 'مریوان',
                'Bane' => 'بانه',
            ],
            'Lorestan' => [
                'Khorram Abad' => 'خرم‌آباد',
                'Brojerd' => 'بروجرد',
                'Dorud' => 'دورود',
            ],
            'Markazi' => [
                'Arak' => 'اراک',
                'Saveh' => 'ساوه',
                'Khomein'=> 'خمین',
                'Mohalat' => 'محلات',
            ],
            'Mazandaran' => [
                'Sari' => 'ساری',
                'Babol'=> 'بابل',
                'Amol'=>'آمل',
                'Qaeem Shahr' => 'قائم‌شهر',
            ],
            'Qazvin' => [
                'Qazvin' => 'قزوین',
                'Alvand' => 'الوند',
            ],
            'Qom' => [
                'Qom' => 'قم',
            ],
            'Semnan' => [
                'Semnan' => 'سمنان',
                'Shahrood' => 'شاهرود',
                'Damqan' => 'دامغان',
                'Garmsar' => 'گرمسار',
            ],
            'Sistan and Baluchestan' => [
                'Zahedan' => 'زاهدان',
                'Zabol' => 'زابل',
                'Chabahar' => 'چابهار',
            ],
            'Tehran' => [
                'Tehran' => 'تهران',
                'Islam Shahr' => 'اسلام‌شهر',
                'Golestan' => 'گلستان',
                'Qods' => 'قدس',
            ],
            'Yazd' => [
                'Yazd' => 'یزد',
                'Ardakan'=> 'اردکان'
            ],
            'Zanjan' => [
                'Zanjan' => 'زنجان',
            ],
        ];
    }
}