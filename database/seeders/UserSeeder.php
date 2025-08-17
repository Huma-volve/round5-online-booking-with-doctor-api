<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dr. Ahmed',
            'email' => 'dr.ahmed@example.com',
            'password' => bcrypt('123456789'), // كلمة السر: password
            
        ]);
    }
}
