<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static count()
 */
class Certificate extends Model
{
    use HasFactory , Searchable , SoftDeletes;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['name'];


    public function users(): HasMany
    {
        return $this->hasMany(UserCertificate::class);
    }

    public function params(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value , true),
            set: fn($value) => json_encode($value)
        );
    }

    public static function certificateParams()
    {
        return [
            '{category}' => 'دسته بندی',
            '{course}' => 'دوره اموزشی',
            '{date}' => 'تاریخ صدور',
            '{code}' => 'کد گواهینامه',
            '{course_id}' => 'کد دوره',
            '{user_name}' => 'نام دانش اموز',
            '{user_father_name}' => 'نام پدر دانش اموز',
            '{user_code_id}' => 'شماره ملی دانش اموز',
            '{user_city}' => 'شهر کاربر',
            '{start_date}' => 'تاریخ شروع دوره',
            '{finish_date}' => 'تاریح پایان  دوره',
            '{hours}' => 'ساعت های اموزشی',
            '{organ_name}' => 'نام اموزشگاه',
            '{score}' => 'نمره کسب شده',
        ];
    }

}
