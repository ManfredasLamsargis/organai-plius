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
        // Mano namas
        $pickup = Coordinate::create([
            'latitude' => 54.891989432731,
            'longitude' => 24.0015467116237
        ]);

        // Krautuvėlė pas Rasą
        $drop = Coordinate::create([
            'latitude' => 54.86437219575025, 
            'longitude' => 23.986040543171335
        ]);

        Delivery::create([
            'pickup_point_coordinate_id' => $pickup->id,
            'drop_point_coordinate_id' => $drop->id,
            'current_location_coordinate_id' => null,
            'generated_route_id' => null,
        ]);

        // Mano namas
        $pickup = Coordinate::create([
            'latitude' => 54.891989432731,
            'longitude' => 24.0015467116237
        ]);

        // Autoservisas
        $drop = Coordinate::create([
            'latitude' => 54.919872841581864, 
            'longitude' => 23.948425927667238
        ]);

        Delivery::create([
            'pickup_point_coordinate_id' => $pickup->id,
            'drop_point_coordinate_id' => $drop->id,
            'current_location_coordinate_id' => null,
            'generated_route_id' => null,
        ]);

        // KTU
        $pickup = Coordinate::create([
            'latitude' => 54.89968425015072,
            'longitude' => 23.961933117768396
        ]);

        // Profkė
        $drop = Coordinate::create([
            'latitude' => 54.9205441510663, 
            'longitude' => 23.99381522946014
        ]);

        Delivery::create([
            'pickup_point_coordinate_id' => $pickup->id,
            'drop_point_coordinate_id' => $drop->id,
            'current_location_coordinate_id' => null,
            'generated_route_id' => null,
        ]);
    }
}
