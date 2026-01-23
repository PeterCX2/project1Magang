<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $user  = Role::create(['name' => 'user']);

        $permission = [
            Permission::create(['name' => 'view role']),
            Permission::create(['name' => 'create role']),
            Permission::create(['name' => 'edit role']),
            Permission::create(['name' => 'delete role']),
            Permission::create(['name' => 'view user']),
            Permission::create(['name' => 'create user']),
            Permission::create(['name' => 'edit user']),
            Permission::create(['name' => 'delete user']),
            Permission::create(['name' => 'view film']),
            Permission::create(['name' => 'edit film']),
            Permission::create(['name' => 'create film']),
            Permission::create(['name' => 'delete film']),
            Permission::create(['name' => 'view home']),
            Permission::create(['name' => 'view category']),
            Permission::create(['name' => 'create category']),
            Permission::create(['name' => 'delete category']),
            Permission::create(['name' => 'view audit']),
            Permission::create(['name' => 'delete audit']),
        ];

        $superAdmin->givePermissionTo($permission);
    }
}
