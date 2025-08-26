<?php

namespace Database\Seeders;

use App\Models\Specialist;
use App\Models\Specialty;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    public function run(): void
    {
  $specialists = [
    [
        'id' => 1,
        'name_en' => 'Dentist',
        'name_ar' => 'طبيب أسنان',
        'description' => 'Dental and oral care specialist',
        'icon' => 'specialists_images/dentist-icon.svg',
        'status' => true
    ],
    [
        'id' => 2,
        'name_en' => 'Cardiologist',
        'name_ar' => 'طبيب قلب',
        'description' => 'Heart and blood vessel specialist',
        'icon' => 'specialists_images/cardiology-icon.svg',
        'status' => true
    ],
    [
        'id' => 3,
        'name_en' => 'General Practitioner',
        'name_ar' => 'طبيب عام',
        'description' => 'General health care provider',
        'icon' => 'specialists_images/gp-icon.svg',
        'status' => true
    ],
    [
        'id' => 4,
        'name_en' => 'ENT',
        'name_ar' => 'أنف وأذن وحنجرة',
        'description' => 'Ear, nose, and throat specialist',
        'icon' => 'specialists_images/ent-icon.svg',
        'status' => true
    ],
    [
        'id' => 5,
        'name_en' => 'Orthopedic',
        'name_ar' => 'طبيب عظام',
        'description' => 'Bone and joint specialist',
        'icon' => 'specialists_images/orthopedic-icon.svg',
        'status' => true
    ],
    [
        'id' => 6,
        'name_en' => 'Neurologist',
        'name_ar' => 'طبيب أعصاب',
        'description' => 'Brain and nervous system specialist',
        'icon' => 'specialists_images/neurologist-icon.svg',
        'status' => true
    ],
    [
        'id' => 7,
        'name_en' => 'Pulmonologist',
        'name_ar' => 'طبيب صدر',
        'description' => 'Lung and respiratory specialist',
        'icon' => 'specialists_images/pulmonologist-icon.svg',
        'status' => true
    ],
    [
        'id' => 8,
        'name_en' => 'Ophthalmologist',
        'name_ar' => 'طبيب عيون',
        'description' => 'Eye and vision specialist',
        'icon' => 'specialists_images/ophthalmologist-icon.svg',
        'status' => true
    ],
    [
        'id' => 9,
        'name_en' => 'Psychiatrist',
        'name_ar' => 'طبيب نفسي',
        'description' => 'Mental health specialist',
        'icon' => 'specialists_images/psychiatrist-icon.svg',
        'status' => true
    ],
    [
        'id' => 10,
        'name_en' => 'Endocrinologist',
        'name_ar' => 'طبيب غدد صماء',
        'description' => 'Hormone and gland specialist',
        'icon' => 'specialists_images/endocrinologist-icon.svg',
        'status' => true
    ],
    [
        'id' => 11,
        'name_en' => 'Gastroenterologist',
        'name_ar' => 'طبيب جهاز هضمي',
        'description' => 'Digestive system specialist',
        'icon' => 'specialists_images/gastroenterologist-icon.svg',
        'status' => true
    ]
    
];

  foreach ($specialists as $specialist) {
            \App\Models\Specialist::create($specialist);
        }
    }
}
