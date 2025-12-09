<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserAddress;

class UserAddressSeeder extends Seeder
{
    public function run(): void
    {

        UserAddress::truncate();
        // Fetch ONLY normal users
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {

            // Generate 1–3 random addresses per user
            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {
                UserAddress::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => fake()->phoneNumber(),
                    'country' => fake()->country(),
                    'state' => fake()->state(),
                    'city' => fake()->city(),
                    'zip' => fake()->postcode(),
                    'address' => fake()->address(),
                ]);
            }
        }
    }
}
