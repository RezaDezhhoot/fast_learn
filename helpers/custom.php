<?php

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
        storages()['local'] => Storage::disk('private'),
        storages()['FTP'] => Storage::build([
            'driver' => 'FTP',
            'root' => env('FTP_ROOT',$SettingRepository->getRow('ftp_root')),
            'host' => env('FTP_HOST',$SettingRepository->getRow('ftp_ip')),
            'username' => env('FTP_USERNAME',$SettingRepository->getRow('ftp_username')),
            'password' => env('FTP_PASSWORD',$SettingRepository->getRow('ftp_password')),
            'port' => env('FTP_PORT',(int)$SettingRepository->getRow('ftp_port') ?? 21),
            'ssl' => $SettingRepository->getRow('ftp_ssl') == 1,
            'timeout' => 120,
        ]),
        storages()['s3'] => Storage::build([
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID',emptyToNull($SettingRepository->getRow('s3_key'))),
            'secret' => env('AWS_SECRET_ACCESS_KEY',emptyToNull($SettingRepository->getRow('s3_secret'))),
            'region' => env('AWS_DEFAULT_REGION',emptyToNull($SettingRepository->getRow('s3_region'))),
            'bucket' => env('AWS_BUCKET',emptyToNull($SettingRepository->getRow('s3_bucket'))),
            'url' => env('AWS_URL',emptyToNull($SettingRepository->getRow('s3_url'))),
            'endpoint' => env('AWS_ENDPOINT',emptyToNull($SettingRepository->getRow('s3_endpoint'))),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', $SettingRepository->getRow('s3_use_path_style_endpoint') == 1),
            'throw' => false,
        ]),
        storages()['SFTP'] => Storage::build([
            'driver' => 'SFTP',
            'host' => env('SFTP_HOST',$SettingRepository->getRow('sftp_host')),
            'username' => env('SFTP_USERNAME',$SettingRepository->getRow('sftp_username')),
            'password' => env('SFTP_PASSWORD',$SettingRepository->getRow('sftp_password')),
            'privateKey' => env('SFTP_PRIVATE_KEY',emptyToNull($SettingRepository->getRow('sftp_privateKey'))),
            'hostFingerprint' => env('SFTP_HOST_FINGERPRINT',emptyToNull($SettingRepository->getRow('sftp_hostFingerprint'))),
            'maxTries' => (int)$SettingRepository->getRow('sftp_maxTries'),
            'passphrase' => env('SFTP_PASSPHRASE',emptyToNull($SettingRepository->getRow('sftp_passphrase'))),
            'port' => env('SFTP_PORT' ,(int)$SettingRepository->getRow('sftp_port')),
            'root' => env('SFTP_ROOT',$SettingRepository->getRow('sftp_root')),
            'timeout' => 30,
            'useAgent' => $SettingRepository->getRow('sftp_useAgent') == 1,
        ]),

        default => Storage::disk('public')
    };
}

#[ArrayShape(['local' => "string", 'FTP' => "string", 's3' => "string", 'SFTP' => "string"])] function storages(): array
{
    return [
        'local' => '1',
        'FTP' => '2',
        's3' => '3',
        'SFTP' => '4'
    ];
}

function getAvailableStorages(): array
{
    $SettingRepository = app(SettingRepositoryInterface::class);
    $storages = [];
    foreach (storages() as $key => $item)
        if ((bool)$SettingRepository->getRow("{$key}_available") || $key == 'local')
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
