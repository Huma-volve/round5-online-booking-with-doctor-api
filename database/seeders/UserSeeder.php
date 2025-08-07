<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Ahmed Mohamed',
            'email' => 'ahmed@example.com',
            'password' => bcrypt('password'),
            'phone' => '0501234567',
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Sara Ahmed',
            'email' => 'sara@example.com',
            'password' => bcrypt('password'),
            'phone' => '0507654321',
            'email_verified_at' => now(),
        ]);

        \App\Models\User::create([
            'name' => 'Mohamed Ali',
            'email' => 'mohamed@example.com',
            'password' => bcrypt('password'),
            'phone' => '0509876543',
            'email_verified_at' => now(),
        ]);

        $this->command->info('Users seeded successfully!');
    }
}
