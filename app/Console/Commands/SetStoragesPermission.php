<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class SetStoragesPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom_storage:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'storage settings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PermissionRepositoryInterface $permissionRepository , RoleRepositoryInterface $roleRepository)
    {
        $permissions = [
            ['name' => 'show_storages' , 'guard_name'=> 'web'],
            ['name' => 'edit_storages', 'guard_name'=> 'web'],
            ['name' => 'delete_storages', 'guard_name'=> 'web'],
        ];
        try {
            DB::beginTransaction();
            $permissionRepository->insert($permissions);
            $administrator = $roleRepository->getByName('administrator');
            $administrator->syncPermissions($permissionRepository->getAll());
            DB::commit();
            echo 'permissions of storages  been set into database successfully';
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
        return 0;
    }
}
