<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'ahmadzidantamimy@gmail.com'],
            [
                'name' => 'zidan',
                'password' => bcrypt('admin1234'),
                'role' => 'admin'
            ]
        );
    }
}
