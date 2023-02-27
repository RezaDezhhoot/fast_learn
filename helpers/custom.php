<?php

use App\Enums\StorageEnum;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;
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
    return Storage::disk(getAvailableStorages()[$storage]);
}

function getAvailableStorages(): array
{
    return array_flip(StorageEnum::storages());
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

function custom_text($key , $raw_text = '' ,$values = [])
{
    $SettingRepository = app(SettingRepositoryInterface::class);

    return str_replace(array_keys($SettingRepository::variables()[$key]),
        $values,
        $raw_text
    );
}
