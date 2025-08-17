<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
    Appointment::create([
    'user_id'            => 1,
    'doctor_profile_id'  => 1,
    'appointment_date'   => Carbon::today()->toDateString(),
    'appointment_time'   => '09:00:00',
    'status'             => 'confirmed',
    'price'              => 100.00

]);
          
    }
}
