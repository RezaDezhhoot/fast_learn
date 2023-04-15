<?php

namespace App\Models;

use App\Enums\CertificateEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $certificate
 */
class UserCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'users_certificates';

    public $timestamps = false;

    public $appends = ['custom_text'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class)->withTrashed();
    }

    public function transcript()
    {
        return $this->belongsTo(Transcript::class);
    }

    public function hours(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::make($this->transcript->created_at ?? now())->diffInHours($this->transcript->updated_at ?? now())
        );
    }

    public function customText(): Attribute
    {
        return Attribute::make(
            get: function () {
                $params = [];
                $vars = array_keys(Certificate::certificateParams());
                $replace = [
                    $this->transcript->course->category->title ?? 'دسته بندی',
                    $this->transcript->course_data['title'] ?? 'عنوان دوره',
                    $this->transcript->certificate_date ?? 'تاریخ',
                    $this->transcript->certificate_code ?? 'تاریخ',
                    $this->transcript->course_data['id'] ?? '000',
                    $this->user->name ?? 'نام کامل',
                    $this->user->details->father_name ?? 'نام پدر',
                    $this->user->details->code_id ?? '0000',
                    $this->user->details->city_label ?? 'نام شهر',
                    $this->transcript->create_date ?? 'تاریخ شروع',
                    $this->transcript->updated_date ?? 'تاریخ پایان',
                    $this->hours,
                    $this->transcript->course->organ->title ?? 'نام سازمان یا اموزشگاه',
                    $this->transcript->score ?? 'نمره کسب شده'
              ];

                if ($this->certificate->content_type == CertificateEnum::CUSTOM && !empty($this->certificate->params) && is_array($this->certificate->params)) {
                    foreach ($this->certificate->params as $key => $param) {
                        $params[$key] = $param;
                        $params[$key]['title'] = str_replace($vars,$replace,$param['title']);
                    }
                }

                return $params;
            }
        );
    }
}
