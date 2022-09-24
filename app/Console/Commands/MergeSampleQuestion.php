<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Artisan;

class MergeSampleQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sample:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sample question settings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PermissionRepositoryInterface $permissionRepository , RoleRepositoryInterface $roleRepository )
    {
        $permissions = [
            ['name' => 'show_samples' , 'guard_name'=> 'web'],
            ['name' => 'edit_samples', 'guard_name'=> 'web'],
            ['name' => 'delete_samples', 'guard_name'=> 'web'],
        ];
        try {
            DB::beginTransaction();
            $permissionRepository->insert($permissions);
            $administrator = $roleRepository->getByName('administrator');
            $administrator->syncPermissions($permissionRepository->getAll());
            DB::commit();
            Artisan::call('migrate');
            echo 'permissions of sample questions and its table has been set into database successfully';
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
        return 0;
    }
}
