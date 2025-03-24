<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        // Create Admin Users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => RoleService::ADMIN,
            'credit' => 0.00,
        ]);

        // Create Employee Users
        User::create([
            'name' => 'Employee User',
            'email' => 'employee@test.com',
            'password' => Hash::make('password123'),
            'role' => RoleService::EMPLOYEE,
            'credit' => 0.00,
        ]);

        // Create Customer Users
        User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => Hash::make('password123'),
            'role' => RoleService::CUSTOMER,
            'credit' => 1000.00,
        ]);
    }
} 