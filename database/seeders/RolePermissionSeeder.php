<?php

namespace Database\Seeders;

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
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $auditorRole = Role::firstOrCreate(['name' => 'auditor']); // New role added

        // Create permissions
        Permission::firstOrCreate(['name' => 'create news']);
        Permission::firstOrCreate(['name' => 'read news']);
        Permission::firstOrCreate(['name' => 'update news']);
        Permission::firstOrCreate(['name' => 'delete news']);

        Permission::firstOrCreate(['name' => 'create user']);
        Permission::firstOrCreate(['name' => 'read user']);
        Permission::firstOrCreate(['name' => 'update user']);
        Permission::firstOrCreate(['name' => 'delete user']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['create news', 'read news', 'update news', 'delete news']);
        $adminRole->givePermissionTo(['create user', 'read user', 'update user', 'delete user']);

        $userRole->givePermissionTo('read user');

        // Assign read permissions to auditor
        $auditorRole->givePermissionTo(['read news', 'read user']);
    }
}
