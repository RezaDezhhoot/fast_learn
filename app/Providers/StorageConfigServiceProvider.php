<?php

namespace App\Providers;

use App\Enums\StorageEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class StorageConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $disks = [
            StorageEnum::FTP_LABEL => [
                'driver' => 'FTP',
                'root' => env('FTP_ROOT',DB::table('settings')->where('name','ftp_root')->first()->value ?? null),
                'host' => env('FTP_HOST',DB::table('settings')->where('name','ftp_ip')->first()->value ?? null),
                'username' => env('FTP_USERNAME',DB::table('settings')->where('name','ftp_username')->first()->value ?? null),
                'password' => env('FTP_PASSWORD',DB::table('settings')->where('name','ftp_password')->first()->value ?? null),
                'port' => env('FTP_PORT',(int)(DB::table('settings')->where('name','ftp_port')->first()->value ?? 21)),
                'ssl' => (DB::table('settings')->where('name','ftp_ssl')->first()->value ?? false) == 1,
                'timeout' => 120,
            ],
            StorageEnum::S3_LABEL => [
                'driver' => 's3',
                'key' => env('AWS_ACCESS_KEY_ID',DB::table('settings')->where('name','s3_key')->first()->value ?? null),
                'secret' => env('AWS_SECRET_ACCESS_KEY',DB::table('settings')->where('name','s3_secret')->first()->value ?? null),
                'region' => env('AWS_DEFAULT_REGION',DB::table('settings')->where('name','s3_region')->first()->value ?? null),
                'bucket' => env('AWS_BUCKET',DB::table('settings')->where('name','s3_bucket')->first()->value ?? null),
                'url' => env('AWS_URL',DB::table('settings')->where('name','s3_url')->first()->value ?? null),
                'endpoint' => env('AWS_ENDPOINT',DB::table('settings')->where('name','s3_endpoint')->first()->value ?? null),
                'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', (DB::table('settings')->where('name','s3_use_path_style_endpoint')->first()->value ?? 0) == 1),
                'throw' => false,
            ],
            StorageEnum::SFTP_LABEL => [
                'driver' => 'SFTP',
                'host' => env('SFTP_HOST',DB::table('settings')->where('name','sftp_host')->first()->value ?? null),
                'username' => env('SFTP_USERNAME',DB::table('settings')->where('name','sftp_username')->first()->value ?? null),
                'password' => env('SFTP_PASSWORD',DB::table('settings')->where('name','sftp_password')->first()->value ?? null),
                'privateKey' => env('SFTP_PRIVATE_KEY',DB::table('settings')->where('name','sftp_privateKey')->first()->value ?? null),
                'hostFingerprint' => env('SFTP_HOST_FINGERPRINT',(DB::table('settings')->where('name','sftp_hostFingerprint')->first()->value ?? null)),
                'maxTries' => (int)(DB::table('settings')->where('name','sftp_maxTries')->first()->value ?? 0),
                'passphrase' => env('SFTP_PASSPHRASE',(DB::table('settings')->where('name','sftp_passphrase')->first()->value ?? null)),
                'port' => env('SFTP_PORT' ,(int)(DB::table('settings')->where('name','sftp_port')->first()->value ?? 22)),
                'root' => env('SFTP_ROOT',(DB::table('settings')->where('name','sftp_root')->first()->value ?? null)),
                'timeout' => 30,
                'useAgent' => (DB::table('settings')->where('name','sftp_useAgent')->first()->value ?? false) == 1,
            ],
            'local' => [
                'driver' => 'local',
                'root' => storage_path('app'),
                'throw' => false,
            ],
            StorageEnum::PUBLIC_LABEL => [
                'driver' => 'local',
                'root' => storage_path('app/public'),
                'url' => env('APP_URL').'/storage',
                'visibility' => 'public',
                'throw' => false,
            ],
            StorageEnum::PRIVATE_LABEL => [
                'driver' => 'local',
                'root' => storage_path('app/private'),
                'url' => '',
                'visibility' => 'private',
                'throw' => false,
            ]
        ];

        config(['filesystems.disks' => $disks]);
    }
}
