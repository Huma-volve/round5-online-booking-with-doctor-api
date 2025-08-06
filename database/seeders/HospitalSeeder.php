<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hospital;
use Carbon\Carbon;
class HospitalSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //	id	name	open_at	close_at	photo	created_at	updated_at	

        $hospital=new Hospital();
        $hospital->name="57375";
        $hospital->open_at=Carbon::now();
        $hospital->close_at=Carbon::now();
        $hospital->photo="hospital image";
        $hospital->save();
    }
}
