<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class OrganChapterRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $course_id;
    public function __construct($course_id)
    {
        $this->course_id = $course_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value,
            Auth::user()->organCourses->where('id',$this->course_id)->first()->chapters->pluck('id')->toArray());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
