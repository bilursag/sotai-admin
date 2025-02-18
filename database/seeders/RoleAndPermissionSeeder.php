<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'delete posts']);
        Permission::create(['name' => 'publish posts']);
        Permission::create(['name' => 'unpublish posts']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'create posts',
            'edit posts',
            'delete posts',
            'unpublish posts',
            'unpublish posts',
        ]);

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo([
            'create posts',
            'edit posts',
            'publish posts',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'create posts',
        ]);
    }
}
