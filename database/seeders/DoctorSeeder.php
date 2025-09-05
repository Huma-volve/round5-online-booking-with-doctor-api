<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Specialist;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some specialists for doctors
        $specialists = Specialist::take(5)->get();
        
        if ($specialists->isEmpty()) {
            $this->command->warn('No specialists found. Please run SpecialistSeeder first.');
            return;
        }

        $doctors = [
            [
                'name' => 'Dr. Ahmed Hassan',
                'email' => 'ahmed.hassan@example.com',
                'phone' => '+201234567890',
                'specialist_id' => $specialists->random()->id,
                'bio' => 'Experienced cardiologist with 15 years of practice in heart surgery and treatment.',
                'available_slots' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'status' => true,
            ],
            [
                'name' => 'Dr. Fatima Ali',
                'email' => 'fatima.ali@example.com',
                'phone' => '+201234567891',
                'specialist_id' => $specialists->random()->id,
                'bio' => 'Specialized in ophthalmology with expertise in cataract and laser surgery.',
                'available_slots' => ['Sunday', 'Monday', 'Wednesday', 'Friday'],
                'status' => true,
            ],
            [
                'name' => 'Dr. Mohamed El-Sayed',
                'email' => 'mohamed.elsayed@example.com',
                'phone' => '+201234567892',
                'specialist_id' => $specialists->random()->id,
                'bio' => 'Orthopedic surgeon with focus on sports injuries and joint replacement.',
                'available_slots' => ['Tuesday', 'Thursday', 'Saturday'],
                'status' => true,
            ],
            [
                'name' => 'Dr. Sara Mahmoud',
                'email' => 'sara.mahmoud@example.com',
                'phone' => '+201234567893',
                'specialist_id' => $specialists->random()->id,
                'bio' => 'Pediatrician with 12 years of experience in child healthcare.',
                'available_slots' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'status' => true,
            ],
            [
                'name' => 'Dr. Omar Khalil',
                'email' => 'omar.khalil@example.com',
                'phone' => '+201234567894',
                'specialist_id' => $specialists->random()->id,
                'bio' => 'Neurologist specializing in brain and nervous system disorders.',
                'available_slots' => ['Monday', 'Wednesday', 'Friday'],
                'status' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::firstOrCreate(
                ['email' => $doctor['email']], // Check by email
                $doctor // Create with all data if not exists
            );
        }

        $this->command->info('Doctors seeded successfully!');
    }
}
