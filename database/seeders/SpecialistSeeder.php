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
    'status' => true
]);

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

Specialist::create([
    'name_en' => 'Pediatrics',
    'name_ar' => 'طب الأطفال',
    'description' => 'Child and adolescent specialist',
    'icon' => 'pediatrics-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Orthopedics',
    'name_ar' => 'جراحة العظام',
    'description' => 'Bone, joint, and muscle specialist',
    'icon' => 'orthopedics-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Ophthalmology',
    'name_ar' => 'طب العيون',
    'description' => 'Eye and vision specialist',
    'icon' => 'ophthalmology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Otolaryngology',
    'name_ar' => 'الأنف والأذن والحنجرة',
    'description' => 'Ear, nose, and throat specialist',
    'icon' => 'otolaryngology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Psychiatry',
    'name_ar' => 'الطب النفسي',
    'description' => 'Mental health specialist',
    'icon' => 'psychiatry-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Oncology',
    'name_ar' => 'طب الأورام',
    'description' => 'Cancer specialist',
    'icon' => 'oncology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Gastroenterology',
    'name_ar' => 'أمراض الجهاز الهضمي',
    'description' => 'Digestive system specialist',
    'icon' => 'gastroenterology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Endocrinology',
    'name_ar' => 'الغدد الصماء',
    'description' => 'Hormone and metabolism specialist',
    'icon' => 'endocrinology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Nephrology',
    'name_ar' => 'أمراض الكلى',
    'description' => 'Kidney specialist',
    'icon' => 'nephrology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Hematology',
    'name_ar' => 'أمراض الدم',
    'description' => 'Blood disorders specialist',
    'icon' => 'hematology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Rheumatology',
    'name_ar' => 'أمراض المفاصل والروماتيزم',
    'description' => 'Joint and autoimmune disease specialist',
    'icon' => 'rheumatology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Pulmonology',
    'name_ar' => 'أمراض الرئة',
    'description' => 'Lung and respiratory system specialist',
    'icon' => 'pulmonology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Urology',
    'name_ar' => 'المسالك البولية',
    'description' => 'Urinary tract and male reproductive specialist',
    'icon' => 'urology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'General Surgery',
    'name_ar' => 'الجراحة العامة',
    'description' => 'Performs a variety of surgical procedures',
    'icon' => 'general-surgery-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Plastic Surgery',
    'name_ar' => 'جراحة التجميل',
    'description' => 'Reconstructive and cosmetic surgery specialist',
    'icon' => 'plastic-surgery-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Emergency Medicine',
    'name_ar' => 'طب الطوارئ',
    'description' => 'Immediate care for acute illnesses and injuries',
    'icon' => 'emergency-medicine-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Anesthesiology',
    'name_ar' => 'التخدير',
    'description' => 'Pain management and anesthesia during surgery',
    'icon' => 'anesthesiology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Family Medicine',
    'name_ar' => 'طب الأسرة',
    'description' => 'Comprehensive care for individuals and families',
    'icon' => 'family-medicine-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Internal Medicine',
    'name_ar' => 'الطب الباطني',
    'description' => 'Adult disease prevention, diagnosis, and treatment',
    'icon' => 'internal-medicine-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Geriatrics',
    'name_ar' => 'طب الشيخوخة',
    'description' => 'Health care for elderly people',
    'icon' => 'geriatrics-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Allergy and Immunology',
    'name_ar' => 'الحساسية والمناعة',
    'description' => 'Specialist in allergic diseases and immune system',
    'icon' => 'allergy-immunology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Infectious Disease',
    'name_ar' => 'الأمراض المعدية',
    'description' => 'Specialist in infectious diseases and outbreaks',
    'icon' => 'infectious-disease-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Sports Medicine',
    'name_ar' => 'طب الرياضة',
    'description' => 'Treatment and prevention of sports injuries',
    'icon' => 'sports-medicine-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Pathology',
    'name_ar' => 'علم الأمراض',
    'description' => 'Study and diagnosis of disease through lab tests',
    'icon' => 'pathology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Radiology',
    'name_ar' => 'الأشعة',
    'description' => 'Medical imaging specialist',
    'icon' => 'radiology-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Obstetrics and Gynecology',
    'name_ar' => 'أمراض النساء والتوليد',
    'description' => 'Women’s reproductive health and childbirth',
    'icon' => 'obgyn-icon.png',
    'status' => true
]);

Specialist::create([
    'name_en' => 'Dentistry',
    'name_ar' => 'طب الأسنان',
    'description' => 'Oral health specialist',
    'icon' => 'dentistry-icon.png',
    'status' => true
]);

    }
}
