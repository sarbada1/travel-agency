<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobsRoles = [
            'admin',
            'editor',
        ];
        foreach ($jobsRoles as $role) {
            $total = Role::where('name', $role)->count();
            if ($total == 0) {
                Role::create(['name' => $role]);
            }
        }
    }
}
