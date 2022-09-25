<?php

namespace App\Providers;

use App\Enums\StorageEnum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        $storage_table = 'storages';
        $disks = [
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

        if (Schema::hasTable($storage_table)) {
            $storages = DB::table($storage_table)
            ->whereNull('deleted_at')
            ->where('status',StorageEnum::AVAILABLE)
            ->get()
            ->map(function($item , $key){
                $item->config = json_decode($item->config,true);

                if (isset($item->config['port'])) 
                    $item->config['port'] = (int)$item->config['port'];
                
                if (isset($item->config['privateKey'])) 
                    $item->config['privateKey'] = emptyToNull($item->config['privateKey']);
                
                return $item;
            })
            ->pluck('config','name')
            ->toArray();
            
            $disks = array_merge($storages,$disks);
        }
        config(['filesystems.disks' => $disks]);
    }
}
