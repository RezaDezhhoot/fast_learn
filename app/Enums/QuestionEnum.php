<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class QuestionEnum extends Enum
{
    const HARD = 'hard';
    const MIDDLE = 'middle';
    const EASY = 'easy';

    public static function getDifficulty()
    {
        return [
            self::HARD => 'سخت',
            self::MIDDLE => 'متوسط',
            self::EASY => 'اسان',
        ];
    }
}
