<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(RolesSeeder::class);
        $this->call(HospitalSeeder::class);
        $this->call(SpecialistSeeder::class);
        $this->call(DoctorProfileSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(NotificationSeeder::class);

    }
}
