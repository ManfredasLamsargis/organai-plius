<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coordinate;
use App\Models\Delivery;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pickup = Coordinate::create([
            'latitude' => 40.712776,
            'longitude' => -74.005974
        ]);

        $drop = Coordinate::create([
            'latitude' => 34.052235,
            'longitude' => -118.243683
        ]);

        Delivery::create([
            'pickup_point_coordinate_id' => $pickup->id,
            'drop_point_coordinate_id' => $drop->id,
            'current_location_coordinate_id' => null,
            'generated_route_id' => null
        ]);
    }
}
