<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import User model
use App\Models\Role; // Import Role model
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy role_id của Admin
        $adminRole = Role::where('role_name', 'Admin')->first();

        // Lấy role_id của Staff
        $staffRole = Role::where('role_name', 'Staff')->first();

        // Lấy role_id của Customer
        $customerRole = Role::where('role_name', 'Customer')->first();

        if ($adminRole && !User::where('email', 'msdat2002@gmail.com')->exists()) {
            User::create([
                'username' => 'admin',
                'email' => 'msdat2002@gmail.com',
                'password' => Hash::make('password'),
                'full_name' => 'Mai Sỹ Đạt',
                'phone_number' => '0337555933',
                'address' => '123 Admin Street',
                'role_id' => $adminRole->role_id,
                'is_active' => true,
            ]);
        }

        // Tạo tài khoản Staff
        if ($staffRole && !User::where('email', 'cheng@gmail.com')->exists()) {
            User::create([
                'username' => 'staff',
                'email' => 'cheng@gmail.com',
                'password' => Hash::make('password'),
                'full_name' => 'Hoàng Thùy Trang',
                'phone_number' => '0987654321',
                'address' => '456 Staff Road',
                'role_id' => $staffRole->role_id,
                'is_active' => true,
            ]);
        }

        // Tạo tài khoản Customer mẫu
        if ($customerRole && !User::where('email', 'customer@example.com')->exists()) {
            User::create([
                'username' => 'customer',
                'email' => 'customer@example.com',
                'password' => Hash::make('password'),
                'full_name' => 'Customer User',
                'phone_number' => '0909090909',
                'address' => '789 Customer Lane',
                'role_id' => $customerRole->role_id,
                'is_active' => true,
            ]);
        }
    }
}
