<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DoctorSchedule;
use Carbon\Carbon;

class DoctorScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            ['doctor_id' => 1, 'day' => 'sunday', 'start_time' => '08:00:00', 'end_time' => '14:00:00'],
            ['doctor_id' => 2, 'day' => 'monday', 'start_time' => '09:00:00', 'end_time' => '15:00:00'],
            ['doctor_id' => 3, 'day' => 'tuesday', 'start_time' => '10:00:00', 'end_time' => '16:00:00'],
            ['doctor_id' => 4, 'day' => 'wednesday', 'start_time' => '11:00:00', 'end_time' => '17:00:00'],
            ['doctor_id' => 5, 'day' => 'thursday', 'start_time' => '12:00:00', 'end_time' => '18:00:00'],
            ['doctor_id' => 6, 'day' => 'friday', 'start_time' => '08:00:00', 'end_time' => '14:00:00'],
            ['doctor_id' => 7, 'day' => 'saturday', 'start_time' => '09:00:00', 'end_time' => '15:00:00'],
            ['doctor_id' => 8, 'day' => 'sunday', 'start_time' => '10:00:00', 'end_time' => '16:00:00'],
            ['doctor_id' => 9, 'day' => 'monday', 'start_time' => '11:00:00', 'end_time' => '17:00:00'],
            ['doctor_id' => 10, 'day' => 'tuesday', 'start_time' => '12:00:00', 'end_time' => '18:00:00'],
            ['doctor_id' => 11, 'day' => 'wednesday', 'start_time' => '08:00:00', 'end_time' => '14:00:00'],
        ];

        foreach ($schedules as $schedule) {
            DoctorSchedule::create([
                'doctor_id' => $schedule['doctor_id'],
                'day' => $schedule['day'],
                'start_time' => Carbon::parse($schedule['start_time']),
                'end_time' => Carbon::parse($schedule['end_time']),
            ]);
        }
    }
}