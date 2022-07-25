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
        StorageEnum::PRIVATE => Storage::disk(StorageEnum::PRIVATE_LABEL),
        StorageEnum::FTP =>  Storage::disk(StorageEnum::FTP_LABEL),
        StorageEnum::S3 => Storage::disk(StorageEnum::S3_LABEL),
        StorageEnum::SFTP => Storage::disk(StorageEnum::SFTP_LABEL),
        default => Storage::disk(StorageEnum::PUBLIC_LABEL)
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

function rateLimiter($value , int $decalSeconds = 3 * 60 * 60 ,int $max_tries = 6): bool|string
{
    $rateKey = 'verify-attempt:' . $value . '|' . request()->ip();
    if (RateLimiter::tooManyAttempts($rateKey, app(SettingRepositoryInterface::class)
            ->getRow('dos_count') ?? $max_tries)) {
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
