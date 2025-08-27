<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DoctorProfile;

class DoctorProfileSeeder extends Seeder
{
    public function run(): void
    {
        $profiles = [
            [
                'user_id' => 1,
                'specialist_id' => 1,
                'hospital_id' => 1,
                'about' => 'Magister in eyes surgery with 20 years of experience',
                'experience_years' => 20,
                'price_per_hour' => 60
            ],
            [
                'user_id' => 2,
                'specialist_id' => 2,
                'hospital_id' => 1,
                'about' => 'Experienced cardiologist with a focus on preventive care',
                'experience_years' => 15,
                'price_per_hour' => 70
            ],
            [
                'user_id' => 3,
                'specialist_id' => 3,
                'hospital_id' => 1,
                'about' => 'General Practitioner with a holistic approach',
                'experience_years' => 10,
                'price_per_hour' => 50
            ],
            [
                'user_id' => 4,
                'specialist_id' => 4,
                'hospital_id' => 1,
                'about' => 'ENT specialist with a passion for patient care',
                'experience_years' => 12,
                'price_per_hour' => 65
            ],
            [
                'user_id' => 5,
                'specialist_id' => 5,
                'hospital_id' => 1,
                'about' => 'Orthopedic doctor focusing on sports injuries',
                'experience_years' => 18,
                'price_per_hour' => 80
            ],
            [
                'user_id' => 6,
                'specialist_id' => 6,
                'hospital_id' => 1,
                'about' => 'Neurologist dedicated to cutting-edge research',
                'experience_years' => 22,
                'price_per_hour' => 90
            ],
            [
                'user_id' => 7,
                'specialist_id' => 7,
                'hospital_id' => 1,
                'about' => 'Pulmonologist with expertise in respiratory therapy',
                'experience_years' => 14,
                'price_per_hour' => 75
            ],
            [
                'user_id' => 8,
                'specialist_id' => 8,
                'hospital_id' => 1,
                'about' => 'Ophthalmologist with specialization in cataract surgery',
                'experience_years' => 19,
                'price_per_hour' => 85
            ],
            [
                'user_id' => 9,
                'specialist_id' => 9,
                'hospital_id' => 1,
                'about' => 'Psychiatrist focusing on adolescent mental health',
                'experience_years' => 9,
                'price_per_hour' => 55
            ],
            [
                'user_id' => 10,
                'specialist_id' => 10,
                'hospital_id' => 1,
                'about' => 'Endocrinologist with a focus on diabetes management',
                'experience_years' => 16,
                'price_per_hour' => 78
            ],
            [
                'user_id' => 11,
                'specialist_id' => 11,
                'hospital_id' => 1,
                'about' => 'Gastroenterologist with expertise in digestive disorders',
                'experience_years' => 17,
                'price_per_hour' => 82
            ],
            // Additional doctor profiles can be added here
        ];

        foreach ($profiles as $profile) {
            DoctorProfile::create($profile);
        }
    }
}