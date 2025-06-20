<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kiểm tra xem các role đã tồn tại chưa để tránh trùng lặp khi chạy lại
        // DB::table('roles')->insertOrIgnore([
        //     ['role_id' => 1, 'role_name' => 'Admin'],
        //     ['role_id' => 2, 'role_name' => 'Staff'],
        //     ['role_id' => 3, 'role_name' => 'Customer'],
        // ]);

        DB::table('roles')->insertOrIgnore([
            [
                'role_id' => (string) Str::uuid(),
                'role_name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => (string) Str::uuid(),
                'role_name' => 'Staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_id' => (string) Str::uuid(),
                'role_name' => 'Customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
