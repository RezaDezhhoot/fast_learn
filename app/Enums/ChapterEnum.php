<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ChapterEnum extends Enum
{
    const PUBLISHED = 'published' , DRAFT = 'draft';

    public static function getStatus(): array
    {
        return  [
            self::PUBLISHED => 'منتشر شده',
            self::DRAFT => 'پیشنویس',
        ];
    }

    const TRANSCRIPT_PENDING = 'transcript_pending' , TRANSCRIPT_ACCEPTED = 'transcript_accept' , TRANSCRIPT_REJECTED = 'transcript_rejected';

    public static function getTranscriptStatus(): array
    {
        return [
            self::TRANSCRIPT_PENDING => 'در انتظار بررسی',
            self::TRANSCRIPT_ACCEPTED => 'تایید شده',
            self::TRANSCRIPT_REJECTED => 'رد شده',
        ];
    }
}
