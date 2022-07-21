<?php

namespace App\Console\Commands;

use App\Enums\UserEnum;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Console\Command;
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
        $permissions = [
            ['name' => 'show_dashboard' , 'guard_name'=> 'web'],
            ['name' => 'show_orders', 'guard_name'=> 'web'],
            ['name' => 'edit_orders', 'guard_name'=> 'web'],
            ['name' => 'delete_orders', 'guard_name'=> 'web'],

            ['name' => 'show_events', 'guard_name'=> 'web'],
            ['name' => 'edit_events', 'guard_name'=> 'web'],
            ['name' => 'delete_events', 'guard_name'=> 'web'],

            ['name' => 'show_courses', 'guard_name'=> 'web'],
            ['name' => 'edit_courses', 'guard_name'=> 'web'],
            ['name' => 'cancel_courses', 'guard_name'=> 'web'],
            ['name' => 'show_episodes', 'guard_name'=> 'web'],
            ['name' => 'edit_episodes', 'guard_name'=> 'web'],
            ['name' => 'delete_episodes', 'guard_name'=> 'web'],
            ['name' => 'show_tickets', 'guard_name'=> 'web'],
            ['name' => 'edit_tickets', 'guard_name'=> 'web'],
            ['name' => 'delete_tickets', 'guard_name'=> 'web'],
            ['name' => 'show_notifications', 'guard_name'=> 'web'],
            ['name' => 'edit_notifications', 'guard_name'=> 'web'],
            ['name' => 'delete_notifications', 'guard_name'=> 'web'],
            ['name' => 'show_reductions', 'guard_name'=> 'web'],
            ['name' => 'edit_reductions', 'guard_name'=> 'web'],
            ['name' => 'delete_reductions', 'guard_name'=> 'web'],
            ['name' => 'show_teachers', 'guard_name'=> 'web'],
            ['name' => 'edit_teachers', 'guard_name'=> 'web'],
            ['name' => 'show_transcripts', 'guard_name'=> 'web'],
            ['name' => 'edit_transcripts', 'guard_name'=> 'web'],
            ['name' => 'delete_transcripts', 'guard_name'=> 'web'],
            ['name' => 'show_comments', 'guard_name'=> 'web'],
            ['name' => 'edit_comments', 'guard_name'=> 'web'],
            ['name' => 'delete_comments', 'guard_name'=> 'web'],
            ['name' => 'show_users', 'guard_name'=> 'web'],
            ['name' => 'edit_users', 'guard_name'=> 'web'],
            ['name' => 'delete_users', 'guard_name'=> 'web'],
            ['name' => 'show_certificates', 'guard_name'=> 'web'],
            ['name' => 'edit_certificates', 'guard_name'=> 'web'],
            ['name' => 'delete_certificates', 'guard_name'=> 'web'],
            ['name' => 'show_categories', 'guard_name'=> 'web'],
            ['name' => 'edit_categories', 'guard_name'=> 'web'],
            ['name' => 'delete_categories', 'guard_name'=> 'web'],
            ['name' => 'show_articles', 'guard_name'=> 'web'],
            ['name' => 'edit_articles', 'guard_name'=> 'web'],
            ['name' => 'delete_articles', 'guard_name'=> 'web'],
            ['name' => 'show_questions', 'guard_name'=> 'web'],
            ['name' => 'edit_questions', 'guard_name'=> 'web'],
            ['name' => 'delete_questions', 'guard_name'=> 'web'],
            ['name' => 'show_quizzes', 'guard_name'=> 'web'],
            ['name' => 'edit_quizzes', 'guard_name'=> 'web'],
            ['name' => 'delete_quizzes', 'guard_name'=> 'web'],
            ['name' => 'show_payments', 'guard_name'=> 'web'],
            ['name' => 'delete_payments', 'guard_name'=> 'web'],
            ['name' => 'show_tags', 'guard_name'=> 'web'],
            ['name' => 'edit_tags', 'guard_name'=> 'web'],
            ['name' => 'delete_tags', 'guard_name'=> 'web'],
            ['name' => 'edit_tasks', 'guard_name'=> 'web'],
            ['name' => 'delete_tasks', 'guard_name'=> 'web'],
            ['name' => 'show_tasks', 'guard_name'=> 'web'],
            ['name' => 'show_roles', 'guard_name'=> 'web'],
            ['name' => 'edit_roles', 'guard_name'=> 'web'],
            ['name' => 'delete_roles', 'guard_name'=> 'web'],
            ['name' => 'show_settings', 'guard_name'=> 'web'],
            ['name' => 'show_settings_base', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_base', 'guard_name'=> 'web'],
            ['name' => 'show_settings_home', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_home', 'guard_name'=> 'web'],
            ['name' => 'show_settings_sms', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_sms', 'guard_name'=> 'web'],
            ['name' => 'show_settings_aboutUs', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_aboutUs', 'guard_name'=> 'web'],
            ['name' => 'show_settings_contactUs', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_contactUs', 'guard_name'=> 'web'],
            ['name' => 'show_settings_fag', 'guard_name'=> 'web'],
            ['name' => 'edit_settings_fag', 'guard_name'=> 'web'],
            ['name' => 'show_organizations', 'guard_name'=> 'web'],
            ['name' => 'edit_organizations', 'guard_name'=> 'web'],
            ['name' => 'delete_organizations', 'guard_name'=> 'web'],

            ['name' => 'public_driver', 'guard_name'=> 'web'],
            ['name' => 'private_driver', 'guard_name'=> 'web'],
            ['name' => 'ftp_driver', 'guard_name'=> 'web'],
            ['name' => 'sftp_driver', 'guard_name'=> 'web'],
            ['name' => 's3_driver', 'guard_name'=> 'web'],

            ['name' => 'show_contacts', 'guard_name'=> 'web'],
            ['name' => 'edit_contacts', 'guard_name'=> 'web'],
            ['name' => 'delete_contacts', 'guard_name'=> 'web'],
            ['name' => 'show_logs', 'guard_name'=> 'web'],
        ];
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
            $permissionRepository->insert($permissions);
            $admin = $roleRepository->create(['name' => 'admin']);
            $super_admin = $roleRepository->create(['name' => 'super_admin']);
            $administrator = $roleRepository->create(['name' => 'administrator']);
            $super_admin->syncPermissions($permissionRepository->getAll());
            $administrator->syncPermissions($permissionRepository->getAll());
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
