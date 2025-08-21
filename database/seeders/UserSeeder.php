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

\App\Models\User::create([
    'name' => 'Hassan Youssef',
    'email' => 'hassan@example.com',
    'password' => bcrypt('password'),
    'phone' => '0501122334',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Mona Samir',
    'email' => 'mona@example.com',
    'password' => bcrypt('password'),
    'phone' => '0502233445',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Omar Khaled',
    'email' => 'omar@example.com',
    'password' => bcrypt('password'),
    'phone' => '0503344556',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Layla Hussein',
    'email' => 'layla@example.com',
    'password' => bcrypt('password'),
    'phone' => '0504455667',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Youssef Nabil',
    'email' => 'youssef@example.com',
    'password' => bcrypt('password'),
    'phone' => '0505566778',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Nour Hany',
    'email' => 'nour@example.com',
    'password' => bcrypt('password'),
    'phone' => '0506677889',
    'email_verified_at' => now(),
]);

\App\Models\User::create([
    'name' => 'Khaled Mansour',
    'email' => 'khaled@example.com',
    'password' => bcrypt('password'),
    'phone' => '0507788990',
    'email_verified_at' => now(),
]);


        $this->command->info('Users seeded successfully!');
    }
}
