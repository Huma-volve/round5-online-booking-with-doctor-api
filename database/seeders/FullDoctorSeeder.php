<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Hospital;
use App\Models\DoctorProfile;

class FullDoctorSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء تخصص (بدون تكرار)
        $specialty = Specialty::firstOrCreate(
            ['name' => 'Eye Surgery'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // 2. إنشاء مستشفى (بدون تكرار + صورة افتراضية)
        $hospital = Hospital::firstOrCreate(
            ['name' => 'Cairo Medical Center'],
            [
                'photo' => 'default-hospital.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // 3. إنشاء يوزر للدكتور (بدون تكرار)
        $doctor = User::firstOrCreate(
            ['email' => 'dr.ahmed@example.com'],
            [
                'name'     => 'Dr. Ahmed',
                'password' => bcrypt('password'),
                // 'role'     => 'doctor',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // 4. إنشاء بروفايل الدكتور (بدون تكرار)
        DoctorProfile::firstOrCreate(
            ['user_id' => $doctor->id],
            [
                'specialties_id'   => $specialty->id,
                'hospital_id'      => $hospital->id,
                'about'            => 'Magister in eyes surgery with 20 years of experience.',
                'experience_years' => 20,
                // 'consultation_fee' => 500,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $this->command->info('FullDoctorSeeder تم تنفيذه بنجاح ✅');
    }
}
