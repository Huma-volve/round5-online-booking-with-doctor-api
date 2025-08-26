<?php

namespace Database\Seeders;

use App\Models\DoctorSchedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//id	doctor_id	day	start_time	end_time	created_at	updated_at

        $hospital=new DoctorSchedule();
        $hospital->doctor_id=1;
        $hospital->day="sunday";
        $hospital->start_time=Carbon::now();
        $hospital->end_time=Carbon::now();
        $hospital->save();
    }
}
