<?php

namespace App\Console\Commands;

use App\Enums\UserEnum;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Database\Seeders\PermissionSeeder;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SetPermissionsAndRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert all of basic permissions and roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param PermissionRepositoryInterface $permissionRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param UserRepositoryInterface $userRepository
     * @return int
     */
    public function handle(PermissionRepositoryInterface $permissionRepository , RoleRepositoryInterface $roleRepository , UserRepositoryInterface $userRepository)
    {
        $administrator = $roleRepository->create(['name' => 'administrator']);
        Artisan::call('db:seed',[
            '--class' => PermissionSeeder::class,
            '--force' => true
        ]);
        $user = [
            'name'=> 'admin',
            'phone' => '1234',
            'status' => UserEnum::CONFIRMED,
            'password' => 'admin',
            'email' => 'example@gmail.com',
            'ip' => 1234
        ];
        try {
            DB::beginTransaction();
            $admin = $roleRepository->create(['name' => 'admin']);
            $teacher = $roleRepository->create(['name' => 'teacher']);
            $super_admin = $roleRepository->create(['name' => 'super_admin']);
            $super_admin->syncPermissions($permissionRepository->getAll());
            $user = $userRepository->create($user);
            $userRepository->syncRoles($user,[$admin,$super_admin,$administrator]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return 0;
    }
}
