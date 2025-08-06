<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Allergy and Immunology', 'icon' => 'allergy-icon'],
            ['name' => 'Anesthesiology', 'icon' => 'anesthesiology-icon'],
            ['name' => 'Cardiology', 'icon' => 'cardiology-icon'],
            ['name' => 'Dermatology', 'icon' => 'dermatology-icon'],
            ['name' => 'Diagnostic Radiology', 'icon' => 'radiology-icon'],
            ['name' => 'Emergency Medicine', 'icon' => 'emergency-icon'],
            ['name' => 'Endocrinology', 'icon' => 'endocrinology-icon'],
            ['name' => 'Family Medicine', 'icon' => 'family-medicine-icon'],
            ['name' => 'Gastroenterology', 'icon' => 'gastroenterology-icon'],
            ['name' => 'Geriatrics', 'icon' => 'geriatrics-icon'],
            ['name' => 'Hematology', 'icon' => 'hematology-icon'],
            ['name' => 'Infectious Disease', 'icon' => 'infectious-icon'],
            ['name' => 'Internal Medicine', 'icon' => 'internal-icon'],
            ['name' => 'Medical Genetics', 'icon' => 'genetics-icon'],
            ['name' => 'Nephrology', 'icon' => 'nephrology-icon'],
            ['name' => 'Neurology', 'icon' => 'neurology-icon'],
            ['name' => 'Neurosurgery', 'icon' => 'neurosurgery-icon'],
            ['name' => 'Nuclear Medicine', 'icon' => 'nuclear-icon'],
            ['name' => 'Obstetrics and Gynecology', 'icon' => 'obgyn-icon'],
            ['name' => 'Oncology', 'icon' => 'oncology-icon'],
            ['name' => 'Ophthalmology', 'icon' => 'ophthalmology-icon'],
            ['name' => 'Orthopedics', 'icon' => 'orthopedics-icon'],
            ['name' => 'Otolaryngology (ENT)', 'icon' => 'ent-icon'],
            ['name' => 'Pathology', 'icon' => 'pathology-icon'],
            ['name' => 'Pediatrics', 'icon' => 'pediatrics-icon'],
            ['name' => 'Physical Medicine & Rehab', 'icon' => 'rehab-icon'],
            ['name' => 'Plastic Surgery', 'icon' => 'plastic-surgery-icon'],
            ['name' => 'Preventive Medicine', 'icon' => 'preventive-icon'],
            ['name' => 'Psychiatry', 'icon' => 'psychiatry-icon'],
            ['name' => 'Pulmonology', 'icon' => 'pulmonology-icon'],
            ['name' => 'Radiation Oncology', 'icon' => 'radiation-icon'],
            ['name' => 'Rheumatology', 'icon' => 'rheumatology-icon'],
            ['name' => 'Sleep Medicine', 'icon' => 'sleep-icon'],
            ['name' => 'Sports Medicine', 'icon' => 'sports-icon'],
            ['name' => 'Surgery', 'icon' => 'surgery-icon'],
            ['name' => 'Thoracic Surgery', 'icon' => 'thoracic-icon'],
            ['name' => 'Urology', 'icon' => 'urology-icon'],
            ['name' => 'Vascular Surgery', 'icon' => 'vascular-icon'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
