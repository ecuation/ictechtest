<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'ADMIN'
        ]);

        $responsible = Role::create([
            'name' => 'RESPONSIBLE'
        ]);

        $assigned = Role::create([
            'name' => 'ASSIGNED'
        ]);

        $usersPermissions = [
            'view_user',
            'view_any_user',
            'create_user',
            'update_user',
            'restore_user',
            'restore_any_user',
            'replicate_user',
            'reorder_user',
            'delete_user',
            'delete_any_user',
            'force_delete_user',
            'force_delete_any_user',
            'lock_user'
        ];

        $documentsPermissions = [
            'view_document',
            'view_any_document',
            'create_document',
            'update_document',
            'restore_document',
            'restore_any_document',
            'replicate_document',
            'reorder_document',
            'delete_document',
            'delete_any_document',
            'force_delete_document',
            'force_delete_any_document',
            'lock_document'
        ];

        collect($usersPermissions)->each(fn ($permission) => Permission::create(['name' => $permission]));
        collect($documentsPermissions)->each(fn ($permission) => Permission::create(['name' => $permission]));

        $admin->givePermissionTo([
            'view_user',
            'view_any_user',
            'create_user',
            'update_user',
            'restore_user',
            'restore_any_user',
            'replicate_user',
            'reorder_user',
            'delete_user',
            'delete_any_user',
            'force_delete_user',
            'force_delete_any_user',
            'lock_user',
            'view_document',
            'view_any_document',
            'create_document',
            'update_document',
            'restore_document',
            'restore_any_document',
            'replicate_document',
            'reorder_document',
            'delete_document',
            'delete_any_document',
            'force_delete_document',
            'force_delete_any_document',
            'lock_document',
        ]);

        $responsible->givePermissionTo([
            'view_user',
            'view_any_user',
            'create_user',
            'view_document',
            'view_any_document',
            'create_document',
        ]);

        $assigned->givePermissionTo([
            'view_user',
            'view_any_user',
            'view_document',
            'view_any_document',
        ]);
    }
}
