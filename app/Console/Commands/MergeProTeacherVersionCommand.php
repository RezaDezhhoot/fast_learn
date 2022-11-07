<?php

namespace App\Console\Commands;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeProTeacherVersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'teacher settings';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PermissionRepositoryInterface $permissionRepository , RoleRepositoryInterface $roleRepository)
    {
        $permissions = [
            ['name' => 'show_teacher_requests' , 'guard_name'=> 'web'],
            ['name' => 'edit_teacher_requests', 'guard_name'=> 'web'],
            ['name' => 'delete_teacher_requests', 'guard_name'=> 'web'],

            ['name' => 'show_new_courses' , 'guard_name'=> 'web'],
            ['name' => 'edit_new_courses', 'guard_name'=> 'web'],
            ['name' => 'delete_new_courses', 'guard_name'=> 'web'],

            ['name' => 'show_checkouts' , 'guard_name'=> 'web'],
            ['name' => 'edit_checkouts', 'guard_name'=> 'web'],

            ['name' => 'show_bank_accounts' , 'guard_name'=> 'web'],
            ['name' => 'edit_bank_accounts', 'guard_name'=> 'web'],
            ['name' => 'delete_bank_accounts', 'guard_name'=> 'web'],

            ['name' => 'show_incoming_methods' , 'guard_name'=> 'web'],
            ['name' => 'edit_incoming_methods', 'guard_name'=> 'web'],
            ['name' => 'delete_incoming_methods', 'guard_name'=> 'web'],
        ];

        try {
            DB::beginTransaction();
            $permissionRepository->insert($permissions);
            $roleRepository->getByName('administrator')->syncPermissions($permissionRepository->getAll());
            DB::commit();
            echo 'permissions of v3.0.2 has been set into database successfully';
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
