<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //city	lat	long	address	addressable_type	addressable_id	
        $hospital=new Location();
        $hospital->city="alex";
        $hospital->lat=2;
        $hospital->long=1;
        $hospital->address="agamy";
        $hospital->addressable_type="user";
        $hospital->addressable_id=2;
        $hospital->save();


        $hospital=new Location();
        $hospital->city="cairo";
        $hospital->lat=2;
        $hospital->long=1;
        $hospital->address="nasr city";
        $hospital->addressable_type="user";
        $hospital->addressable_id=3;
        $hospital->save();



        $hospital=new Location();
        $hospital->city="giza";
        $hospital->lat=2;
        $hospital->long=1;
        $hospital->address="nasr city";
        $hospital->addressable_type="user";
        $hospital->addressable_id=1;
        $hospital->save();



        
    }
}
