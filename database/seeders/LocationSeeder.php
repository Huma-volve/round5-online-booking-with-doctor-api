<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['city' => 'alex', 'lat' => 29.9187, 'long' => 31.2001, 'address' => 'agamy', 'addressable_type' => 'user', 'addressable_id' => 1],
            ['city' => 'cairo', 'lat' => 30.0444, 'long' => 31.2357, 'address' => 'nasr city', 'addressable_type' => 'user', 'addressable_id' => 2],
            ['city' => 'giza', 'lat' => 30.0131, 'long' => 31.2089, 'address' => 'dokki', 'addressable_type' => 'user', 'addressable_id' => 3],
            ['city' => 'hurghada', 'lat' => 27.2579, 'long' => 33.8116, 'address' => 'makadi', 'addressable_type' => 'user', 'addressable_id' => 4],
            ['city' => 'sharm el-sheikh', 'lat' => 27.9158, 'long' => 34.3299, 'address' => 'naama bay', 'addressable_type' => 'user', 'addressable_id' => 5],
            ['city' => 'luxor', 'lat' => 25.6872, 'long' => 32.6396, 'address' => 'karnak', 'addressable_type' => 'user', 'addressable_id' => 6],
            ['city' => 'aswan', 'lat' => 24.0889, 'long' => 32.8998, 'address' => 'high dam', 'addressable_type' => 'user', 'addressable_id' => 7],
            ['city' => 'faiyum', 'lat' => 29.3099, 'long' => 30.8418, 'address' => 'qaroun',
            'addressable_type' => 'user', 'addressable_id' => 8],
            ['city' => 'siwa', 'lat' => 29.2045, 'long' => 25.5199, 'address' => 'oasis', 'addressable_type' => 'user', 'addressable_id' => 9],
            ['city' => 'marsamatruh', 'lat' => 31.3547, 'long' => 27.2373, 'address' => 'ageeba', 'addressable_type' => 'user', 'addressable_id' => 10],
            ['city' => 'minya', 'lat' => 28.1099, 'long' => 30.7500, 'address' => 'mallawi', 'addressable_type' => 'user', 'addressable_id' => 11],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}