<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users and doctors for appointments
        $users = User::where('role', 'user')->take(5)->get();
        $doctors = User::where('role', 'doctor')->take(3)->get();

        if ($users->isEmpty() || $doctors->isEmpty()) {
            $this->command->warn('No users or doctors found. Please run UserSeeder first.');
            return;
        }

        $appointments = [
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(1)->toDateString(),
                'time' => '09:00',
                'status' => 'pending',
                'is_paid' => false,
                'payment_reference' => null,
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(1)->toDateString(),
                'time' => '10:00',
                'status' => 'confirmed',
                'is_paid' => true,
                'payment_reference' => 'PAY_' . strtoupper(uniqid()),
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(2)->toDateString(),
                'time' => '11:00',
                'status' => 'pending',
                'is_paid' => false,
                'payment_reference' => null,
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(2)->toDateString(),
                'time' => '14:00',
                'status' => 'confirmed',
                'is_paid' => true,
                'payment_reference' => 'PAY_' . strtoupper(uniqid()),
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(3)->toDateString(),
                'time' => '15:00',
                'status' => 'canceled',
                'is_paid' => false,
                'payment_reference' => null,
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(4)->toDateString(),
                'time' => '16:00',
                'status' => 'completed',
                'is_paid' => true,
                'payment_reference' => 'PAY_' . strtoupper(uniqid()),
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(5)->toDateString(),
                'time' => '09:00',
                'status' => 'pending',
                'is_paid' => false,
                'payment_reference' => null,
            ],
            [
                'user_id' => $users->random()->id,
                'doctor_id' => $doctors->random()->id,
                'date' => Carbon::today()->addDays(6)->toDateString(),
                'time' => '13:00',
                'status' => 'confirmed',
                'is_paid' => true,
                'payment_reference' => 'PAY_' . strtoupper(uniqid()),
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }

        $this->command->info('Appointments seeded successfully!');
    }
}
