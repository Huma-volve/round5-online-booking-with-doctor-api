<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Specialist;
use App\Models\DoctorProfile;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ComprehensiveDoctorHospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure we have specialists
        $this->ensureSpecialistsExist();
        
        // Create hospitals
        $hospitals = $this->createHospitals();
        
        // Create doctor users and profiles
        $this->createDoctorsWithProfiles($hospitals);
        
        $this->command->info('Comprehensive doctors and hospitals seeded successfully!');
    }

    private function ensureSpecialistsExist()
    {
        $specialists = [
            ['name_en' => 'Cardiologist', 'name_ar' => 'أخصائي أمراض القلب', 'description' => 'Specializes in heart and cardiovascular diseases', 'status' => true],
            ['name_en' => 'Ophthalmologist', 'name_ar' => 'أخصائي العيون', 'description' => 'Specializes in eye and vision care', 'status' => true],
            ['name_en' => 'Orthopedic', 'name_ar' => 'أخصائي العظام', 'description' => 'Specializes in bone and joint disorders', 'status' => true],
            ['name_en' => 'Pediatrician', 'name_ar' => 'طبيب أطفال', 'description' => 'Specializes in children\'s health', 'status' => true],
            ['name_en' => 'Neurologist', 'name_ar' => 'أخصائي الأعصاب', 'description' => 'Specializes in nervous system disorders', 'status' => true],
            ['name_en' => 'Pulmonologist', 'name_ar' => 'أخصائي الصدر', 'description' => 'Specializes in lung and respiratory diseases', 'status' => true],
            ['name_en' => 'Psychiatrist', 'name_ar' => 'طبيب نفسي', 'description' => 'Specializes in mental health', 'status' => true],
            ['name_en' => 'Endocrinologist', 'name_ar' => 'أخصائي الغدد الصماء', 'description' => 'Specializes in hormonal disorders', 'status' => true],
            ['name_en' => 'Gastroenterologist', 'name_ar' => 'أخصائي الجهاز الهضمي', 'description' => 'Specializes in digestive system diseases', 'status' => true],
            ['name_en' => 'ENT', 'name_ar' => 'أخصائي أنف وأذن وحنجرة', 'description' => 'Specializes in ear, nose, and throat', 'status' => true],
            ['name_en' => 'Dermatologist', 'name_ar' => 'أخصائي الجلدية', 'description' => 'Specializes in skin diseases', 'status' => true],
            ['name_en' => 'General Practitioner', 'name_ar' => 'طبيب عام', 'description' => 'General medical practitioner', 'status' => true],
        ];

        foreach ($specialists as $specialist) {
            Specialist::firstOrCreate(
                ['name_en' => $specialist['name_en']],
                $specialist
            );
        }

        $this->command->info('Specialists ensured successfully!');
    }

    private function createHospitals()
    {
        $hospitals = [
            [
                'name' => 'Hope Medical Center',
                'city' => 'Cairo',
                'open_at' => '08:00:00',
                'close_at' => '20:00:00',
                'photo' => 'hospital_hope.jpg'
            ],
            [
                'name' => 'Light Hospital',
                'city' => 'Giza',
                'open_at' => '07:00:00',
                'close_at' => '22:00:00',
                'photo' => 'hospital_light.jpg'
            ],
            [
                'name' => 'Peace Medical Center',
                'city' => 'Alexandria',
                'open_at' => '09:00:00',
                'close_at' => '21:00:00',
                'photo' => 'hospital_peace.jpg'
            ],
            [
                'name' => 'Healing Hospital',
                'city' => 'Mansoura',
                'open_at' => '08:30:00',
                'close_at' => '19:30:00',
                'photo' => 'hospital_healing.jpg'
            ],
            [
                'name' => 'Life Medical Center',
                'city' => 'Tanta',
                'open_at' => '07:30:00',
                'close_at' => '20:30:00',
                'photo' => 'hospital_life.jpg'
            ],
            [
                'name' => 'Future Hospital',
                'city' => 'Luxor',
                'open_at' => '08:00:00',
                'close_at' => '18:00:00',
                'photo' => 'hospital_future.jpg'
            ]
        ];

        $createdHospitals = collect();
        foreach ($hospitals as $hospital) {
            $createdHospital = Hospital::firstOrCreate(
                ['name' => $hospital['name']],
                $hospital
            );
            $createdHospitals->push($createdHospital);
        }

        $this->command->info('Hospitals created successfully!');
        return $createdHospitals;
    }

    private function createDoctorsWithProfiles($hospitals)
    {
        $specialists = Specialist::all();
        $doctors = [
            [
                'name' => 'Dr. Ahmed Mohamed Ali',
                'email' => 'ahmed.mohamed@hospital.com',
                'phone' => '01012345678',
                'specialist_name_en' => 'Cardiologist',
                'about' => 'Senior cardiologist with 15 years of experience in interventional cardiology and heart surgery',
                'experience_years' => 15,
                'price_per_hour' => 300,
                'hospital_name' => 'Hope Medical Center'
            ],
            [
                'name' => 'Dr. Fatima El-Said',
                'email' => 'fatima.elsaid@hospital.com',
                'phone' => '01012345679',
                'specialist_name_en' => 'Ophthalmologist',
                'about' => 'Specialized in eye surgery with expertise in retinal surgery and LASIK procedures',
                'experience_years' => 12,
                'price_per_hour' => 280,
                'hospital_name' => 'Light Hospital'
            ],
            [
                'name' => 'Dr. Mohamed Hassan Ibrahim',
                'email' => 'mohamed.hassan@hospital.com',
                'phone' => '01012345680',
                'specialist_name_en' => 'Orthopedic',
                'about' => 'Orthopedic surgeon specializing in joint replacement and arthroscopic procedures',
                'experience_years' => 18,
                'price_per_hour' => 350,
                'hospital_name' => 'Peace Medical Center'
            ],
            [
                'name' => 'Dr. Sara Mahmoud',
                'email' => 'sara.mahmoud@hospital.com',
                'phone' => '01012345681',
                'specialist_name_en' => 'Pediatrician',
                'about' => 'Pediatric specialist with focus on neonatology and intensive care for children',
                'experience_years' => 10,
                'price_per_hour' => 200,
                'hospital_name' => 'Healing Hospital'
            ],
            [
                'name' => 'Dr. Omar Khalid',
                'email' => 'omar.khalid@hospital.com',
                'phone' => '01012345682',
                'specialist_name_en' => 'Neurologist',
                'about' => 'Neurologist specializing in epilepsy treatment and stroke management',
                'experience_years' => 14,
                'price_per_hour' => 320,
                'hospital_name' => 'Life Medical Center'
            ],
            [
                'name' => 'Dr. Nora Ahmed',
                'email' => 'nora.ahmed@hospital.com',
                'phone' => '01012345683',
                'specialist_name_en' => 'Pulmonologist',
                'about' => 'Pulmonologist with expertise in asthma and allergy treatment',
                'experience_years' => 11,
                'price_per_hour' => 250,
                'hospital_name' => 'Future Hospital'
            ],
            [
                'name' => 'Dr. Youssef Mohamed',
                'email' => 'youssef.mohamed@hospital.com',
                'phone' => '01012345684',
                'specialist_name_en' => 'Psychiatrist',
                'about' => 'Psychiatrist specializing in depression and anxiety disorders treatment',
                'experience_years' => 13,
                'price_per_hour' => 220,
                'hospital_name' => 'Hope Medical Center'
            ],
            [
                'name' => 'Dr. Mona Ali',
                'email' => 'mona.ali@hospital.com',
                'phone' => '01012345685',
                'specialist_name_en' => 'Endocrinologist',
                'about' => 'Endocrinologist with focus on diabetes management and thyroid disorders',
                'experience_years' => 16,
                'price_per_hour' => 270,
                'hospital_name' => 'Light Hospital'
            ],
            [
                'name' => 'Dr. Khaled Mahmoud',
                'email' => 'khaled.mahmoud@hospital.com',
                'phone' => '01012345686',
                'specialist_name_en' => 'Gastroenterologist',
                'about' => 'Gastroenterologist with expertise in therapeutic endoscopy procedures',
                'experience_years' => 17,
                'price_per_hour' => 290,
                'hospital_name' => 'Peace Medical Center'
            ],
            [
                'name' => 'Dr. Heba Rashdy',
                'email' => 'heba.rashdy@hospital.com',
                'phone' => '01012345687',
                'specialist_name_en' => 'ENT',
                'about' => 'ENT specialist with expertise in sinus surgery and nasal procedures',
                'experience_years' => 9,
                'price_per_hour' => 230,
                'hospital_name' => 'Healing Hospital'
            ],
            [
                'name' => 'Dr. Mahmoud El-Sayed',
                'email' => 'mahmoud.elsayed@hospital.com',
                'phone' => '01012345688',
                'specialist_name_en' => 'Dermatologist',
                'about' => 'Dermatologist specializing in skin cancer treatment and cosmetic dermatology',
                'experience_years' => 20,
                'price_per_hour' => 260,
                'hospital_name' => 'Life Medical Center'
            ],
            [
                'name' => 'Dr. Eman Hassan',
                'email' => 'eman.hassan@hospital.com',
                'phone' => '01012345689',
                'specialist_name_en' => 'General Practitioner',
                'about' => 'General practitioner with extensive experience in preventive medicine and primary care',
                'experience_years' => 8,
                'price_per_hour' => 150,
                'hospital_name' => 'Future Hospital'
            ]
        ];

        foreach ($doctors as $doctorData) {
            // Create or find the user (doctor)
            $user = User::firstOrCreate(
                ['email' => $doctorData['email']],
                [
                    'name' => $doctorData['name'],
                    'email' => $doctorData['email'],
                    'password' => Hash::make('password123'), // Default password
                    'phone' => $doctorData['phone'],
                    'type' => 'doctor',
                    'is_notifiable' => true
                ]
            );

            // Find the specialist
            $specialist = $specialists->where('name_en', $doctorData['specialist_name_en'])->first();
            if (!$specialist) {
                $this->command->warn("Specialist {$doctorData['specialist_name_en']} not found for doctor {$doctorData['name']}");
                continue;
            }

            // Find the hospital
            $hospital = $hospitals->where('name', $doctorData['hospital_name'])->first();
            if (!$hospital) {
                $this->command->warn("Hospital {$doctorData['hospital_name']} not found for doctor {$doctorData['name']}");
                continue;
            }

            // Create doctor profile
            $doctorProfile = DoctorProfile::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'specialist_id' => $specialist->id,
                    'hospital_id' => $hospital->id,
                    'about' => $doctorData['about'],
                    'experience_years' => $doctorData['experience_years'],
                    'price_per_hour' => $doctorData['price_per_hour']
                ]
            );

            // Create doctor schedules
            $this->createDoctorSchedules($doctorProfile);
        }

        $this->command->info('Doctors with profiles created successfully!');
    }

    private function createDoctorSchedules($doctorProfile)
    {
        // Generate random schedules for each doctor
        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $timeSlots = [
            ['start_time' => '09:00:00', 'end_time' => '12:00:00'],
            ['start_time' => '14:00:00', 'end_time' => '17:00:00'],
            ['start_time' => '18:00:00', 'end_time' => '21:00:00']
        ];

        // Each doctor works 4-6 days per week
        $workingDays = collect($days)->random(rand(4, 6));
        
        foreach ($workingDays as $day) {
            // Each doctor works 1-2 shifts per day
            $shifts = collect($timeSlots)->random(rand(1, 2));
            
            foreach ($shifts as $shift) {
                DoctorSchedule::firstOrCreate([
                    'doctor_id' => $doctorProfile->id,
                    'day' => $day,
                    'start_time' => $shift['start_time'],
                    'end_time' => $shift['end_time']
                ]);
            }
        }
    }
}
