<?php

namespace App\Models;

use App\Enums\NotificationEnum;
use App\Enums\OrderEnum;
use App\Enums\UserEnum;
use App\Traits\Admin\Searchable;
use Bavix\Wallet\Interfaces\Confirmable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\CanConfirm;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed status
 * @property mixed $id
 * @property mixed $teacher
 * @method static create(array $data)
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static whereBetween(string $string, string[] $array)
 * @method where(array $func_get_args)
 * @method orWhere(array $func_get_args)
 * @method get()
 * @method cursor()
 * @method static select(array $columns)
 * @method static count()
 * @method static orderBy(string $string, string $orderBy)
 */
class User extends Authenticatable implements Wallet, Confirmable
{
    use HasApiTokens, HasFactory, Notifiable , HasWallet , CanConfirm , HasRoles , Searchable ;

    use LogsActivity;

    protected array $searchAbleColumns = ['email','phone'];

    const USER_DEFAULT_IMAGE = 'site/images/icons8-user-30.png';


    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value): string
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    public function setOtpAttribute($value): string
    {
        return $this->attributes['otp'] = Hash::make($value);
    }

    public function getStatusLabelAttribute(): string
    {
        return UserEnum::getStatus()[$this->status];
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Notification::class)->orWhere('type',NotificationEnum::PUBLIC)->orderBy('id','desc');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->withTrashed();
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class)->latest('id')->parent(true);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function getImageAttribute($value)
    {
        if (empty($value))
            return self::USER_DEFAULT_IMAGE;

        return $value;
    }

    public function details(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(UserCertificate::class);
    }

    public static function getNew()
    {
        return User::where('status',UserEnum::NOT_CONFIRMED)->count();
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class)->orderBy('id','desc');
    }

    public function orderDetails(): HasManyThrough
    {
        return $this->hasManyThrough(OrderDetail::class,Order::class)
            ->where('status',OrderEnum::STATUS_COMPLETED)->whereNotNull('course_id')->orderBy('id','desc');
    }

    public function hasCourse($id)
    {
        return $this->orderDetails()->where('status',OrderEnum::STATUS_COMPLETED)->whereHas('course',function ($q) use ($id){
            return $q->where('id',$id);
        })->first();
    }

    public function transcripts(): HasMany
    {
        return $this->hasMany(Transcript::class)->orderBy('id','desc');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class,'teacher_id');
    }

    protected function courseCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->courses()->count(),
        );
    }

    protected function studentsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->courses()->select('id')->withCount(['details' => function ($q){
                return $q->where('status',OrderEnum::STATUS_COMPLETED);
            }])->cursor()->sum('details_count')
        );
    }

    protected function commentsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->courses()->select('id')->withCount('comments')
                ->cursor()->sum('comments_count')
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn () => base64_encode($this->id)
        );
    }

    public function isTeacher(): Attribute
    {
        return Attribute::make(
            get: fn () => !is_null($this->teacher)
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return (new LogOptions())->logAll();
    }

    public function causer_logs(): MorphMany
    {
        return $this->morphMany(Activity::class,'causer');
    }

    public function subject_logs(): MorphMany
    {
        return $this->morphMany(Activity::class,'subject');
    }

    public function applies(): HasMany
    {
        return $this->hasMany(TeacherRequest::class)->latest();
    }

    public function acl()
    {
        return $this->hasMany(StoragePermission::class);
    }

    public function newCourses(): HasMany
    {
        return $this->hasMany(NewCourse::class);
    }

    public function last_activities(): HasMany
    {
        return $this->hasMany(LastActivity::class)->latest();
    }
}
