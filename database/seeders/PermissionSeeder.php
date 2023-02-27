<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

            ['name' => 'show_contacts', 'guard_name'=> 'web'],
            ['name' => 'edit_contacts', 'guard_name'=> 'web'],
            ['name' => 'delete_contacts', 'guard_name'=> 'web'],
            ['name' => 'show_logs', 'guard_name'=> 'web'],

            // v2.0.1
            ['name' => 'show_samples' , 'guard_name'=> 'web'],
            ['name' => 'edit_samples', 'guard_name'=> 'web'],
            ['name' => 'delete_samples', 'guard_name'=> 'web'],

            ['name' => 'show_storages' , 'guard_name'=> 'web'],
            ['name' => 'edit_storages', 'guard_name'=> 'web'],
            ['name' => 'delete_storages', 'guard_name'=> 'web'],

            // v3.0.2
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

            ['name' => 'show_jobs' , 'guard_name'=> 'web'],
            ['name' => 'edit_jobs', 'guard_name'=> 'web'],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->updateOrCreate([
                'name' => $permission['name']
            ],[
                'guard_name' => 'web'
            ]);
        }
        Role::query()->where('name','administrator')->first()->syncPermissions(Permission::all());
    }
}
