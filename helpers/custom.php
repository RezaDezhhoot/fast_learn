<?php

use App\Enums\StorageEnum;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;

function array_value_recursive($key, array $arr): array
{
    $val = array();
    array_walk_recursive($arr, function($v, $k) use($key, &$val){
        if($k == $key) $val[] = $v;
    });
    return $val;
}

function getDisk($storage = null): Filesystem
{
    $SettingRepository = app(SettingRepositoryInterface::class);
    if (is_null($storage))
        $storage = $SettingRepository->getRow('storage');
    return match ($storage) {
        StorageEnum::PRIVATE => Storage::disk('private'),
        StorageEnum::FTP =>  Storage::disk('ftp'),
        StorageEnum::S3 => Storage::disk('s3'),
        StorageEnum::SFTP => Storage::disk('SFTP'),
        default => Storage::disk('public')
    };
}

function getAvailableStorages(): array
{
    $SettingRepository = app(SettingRepositoryInterface::class);
    $storages = [];
    foreach (StorageEnum::storages() as $key => $item)
        if ((bool)$SettingRepository->getRow("{$key}_available") || $key == StorageEnum::PRIVATE_LABEL || $key == StorageEnum::PUBLIC_LABEL)
            $storages[$key] = $item;

    return $storages;
}

function rateLimiter($value , int $decalSeconds = 3 * 60 * 60): bool|string
{
    $rateKey = 'verify-attempt:' . $value . '|' . request()->ip();
    if (RateLimiter::tooManyAttempts($rateKey, app(SettingRepositoryInterface::class)
            ->getRow('dos_count') ?? 6)) {
        return $rateKey;
    }
    RateLimiter::hit($rateKey, $decalSeconds);
    return false;
}

function keyRateLimiter($value): string
{
    return 'verify-attempt:' . $value . '|' . request()->ip();
}

function emptyToNull($value)
{
    if (empty($value))
        return null;

    return $value;
}
