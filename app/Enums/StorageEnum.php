<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StorageEnum extends Enum
{
    // default sotrages
    const PUBLIC = '0' , PRIVATE = '1' , FTP = '2' , S3 = '3' , SFTP = '4';
    const PUBLIC_LABEL = 'public' , PRIVATE_LABEL = 'private' , FTP_LABEL = 'ftp' , S3_LABEL = 's3' , SFTP_LABEL = 'sftp';

    /*
    * custome storages
    *
    * CONST CUSTOM_STORAGE = '5';
    * CONST CUSTOM_STORAGE_LABEL = 'custom_storage';
    *
    */

    
    #[ArrayShape([self::PUBLIC_LABEL => "string", self::PRIVATE_LABEL => "string", self::FTP_LABEL => "string", self::S3_LABEL => "string", self::SFTP_LABEL => "string"])]
    public static function storages(): array
    {
        return [
            self::PUBLIC_LABEL => self::PUBLIC,
            self::PRIVATE_LABEL => self::PRIVATE,
            self::FTP_LABEL => self::FTP,
            self::S3_LABEL => self::S3,
            self::SFTP_LABEL => self::SFTP,
        ];
    }

    #[ArrayShape([self::PUBLIC => "string", self::PRIVATE => "string", self::FTP => "string", self::S3 => "string", self::SFTP => "string"])]
    public static function getStorages(): array
    {
        return [
            self::PUBLIC => self::PUBLIC_LABEL,
            self::PRIVATE => self::PRIVATE_LABEL,
            self::FTP => self::FTP_LABEL,
            self::S3 => self::S3_LABEL,
            self::SFTP => self::SFTP_LABEL,
        ];
    }
}
