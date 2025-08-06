<?php

namespace Database\Seeders;

use App\Models\DoctorProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //user_id	specialties_id	hospital_id	about	experience_years	price_per_hour	
        $doctorProfile=new DoctorProfile();
        $doctorProfile->user_id=1;
        $doctorProfile->specialties_id=1;
        $doctorProfile->hospital_id=1;
        $doctorProfile->about="magster in eyes surgery aand 20 year experience";
        $doctorProfile->experience_years=20;
        $doctorProfile->price_per_hour=60;
        $doctorProfile->save();
    }
}
