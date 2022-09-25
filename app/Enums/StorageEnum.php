<?php

namespace App\Enums;

use App\Repositories\Interfaces\StorageRepositoryInterface;
use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StorageEnum extends Enum
{
    const PUBLIC = '0' , PRIVATE = '1' , FTP = '2'  , SFTP = '4';
    const PUBLIC_LABEL = 'public' , PRIVATE_LABEL = 'private' , FTP_LABEL = 'ftp'  , SFTP_LABEL = 'sftp';
    const AVAILABLE = 'available' , UNAVAILABLE = 'unavailable' , DELETED = 'deleted';

    const PERMISSION_PREFIX = 'custom_storage-';

    const RELATION_KEY_PREFIX = 'cs-';
    
    public static function storages(): array
    {
        $storages = [
            self::PUBLIC_LABEL => self::PUBLIC,
            self::PRIVATE_LABEL => self::PRIVATE,
        ];
        $custome_storages = app(StorageRepositoryInterface::class)
        ->getAll()
        ->pluck('key','name')
        ->toArray();
        $storages = array_merge($custome_storages , $storages);
        return $storages;
    }

    public static function getStorages(): array
    {
        return [
            self::PUBLIC => self::PUBLIC_LABEL,
            self::PRIVATE => self::PRIVATE_LABEL,
            self::FTP => self::FTP_LABEL,
            self::SFTP => self::SFTP_LABEL,
        ];
    }

    public static function getStatus(): array
    {
        return [
            self::AVAILABLE => 'فعال',
            self::UNAVAILABLE => 'غیر فعال',
            self::DELETED => 'حذف شده'
        ];
    }

    public static function getColor(): array
    {
        return [
            self::AVAILABLE => 'success',
            self::UNAVAILABLE => 'warning',
            self::DELETED => 'danger'
        ];
    }
}
