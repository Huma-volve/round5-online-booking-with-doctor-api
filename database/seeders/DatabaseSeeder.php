<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
<<<<<<< HEAD
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
=======
    public function run(): void {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(HospitalSeeder::class);
        $this->call(SpecialistSeeder::class);
        $this->call(DoctorProfileSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(NotificationSeeder::class);

>>>>>>> 624c06ca54501a957b2c6a7396845ab2d261256e
    }
}
