<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'roles_list',
            'roles_create',
            'roles_edit',
            'roles_delete',
            'roles_show',

        ];
        $permissions = [
            'permissions_list',
            'permissions_create',
            'permissions_edit',
            'permissions_delete',
            'permissions_show',
        ];

        foreach ($roles as $role) {
            $total = Permission::where('name', $role)->count();
            if ($total == 0) {
                Permission::create(['name' => $role, 'table_name' => 'roles']);
            }
        }

        foreach ($permissions as $permission) {
            $total = Permission::where('name', $permission)->count();
            if ($total == 0) {
                Permission::create(['name' => $permission, 'table_name' => 'permissions']);
            }
        }
    }
}
