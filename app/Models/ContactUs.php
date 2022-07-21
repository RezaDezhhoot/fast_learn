<?php

namespace App\Models;

use App\Enums\ContactUsEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

/**
 * @method static create(array $data)
 * @method static where(string $string, string $PENDING)
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static find($id)
 * @property mixed $status
 * @property mixed $answer_action
 * @property mixed $created_at
 */
class ContactUs extends Model
{
    use Searchable;

    protected array $searchAbleColumns = ['full_name','phone','email'];

    protected $guarded = ['id'];
    protected $table = 'contact_us';

    use HasFactory;

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => in_array($this->status,array_keys(ContactUsEnum::getStatus())) ?
                ContactUsEnum::getStatus()[$this->status] : ''
        );
    }

    public function actionLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->answer_action,array_keys(ContactUsEnum::getActions())) ?
                ContactUsEnum::getActions()[$this->answer_action] : ''
        );
    }

    public function date(): Attribute
    {
        return Attribute::make(
            get: fn() => Jalalian::forge($this->created_at)->format('%A, %d %B %Y')
        );
    }
}
