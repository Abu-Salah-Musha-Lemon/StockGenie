<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Manager',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Employee',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
