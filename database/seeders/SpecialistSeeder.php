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
        Specialist::create([
            'name_en' => 'Cardiology',
            'name_ar' => 'أمراض القلب',
            'description' => 'Heart and blood vessel specialist',
            'icon' => 'cardiology-icon.png',
            'status' => true]);

        Specialist::create([
            'name_en' => 'Dermatology',
            'name_ar' => 'الأمراض الجلدية',
            'description' => 'Skin specialist',
            'icon' => 'dermatology-icon.png',
            'status' => true
        ]);

        Specialist::create([
            'name_en' => 'Neurology',
            'name_ar' => 'الأعصاب',
            'description' => 'Nervous system specialist',
            'icon' => 'neurology-icon.png',
            'status' => true
        ]);
    }
}
