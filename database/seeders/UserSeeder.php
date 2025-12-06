<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Mcp\Enums\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin user',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'role' => UserRole::Admin,
                'status' => 'active',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'role' =>  UserRole::User,
                'status' => 'active',
                'password' => Hash::make('123'),
            ],
        ]);
    }
}
