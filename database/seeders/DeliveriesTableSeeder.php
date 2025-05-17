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
        for ($i = 0; $i < 10; $i++) {
            $pickup = Coordinate::create([
                'latitude' => fake()->latitude(30, 50),
                'longitude' => fake()->longitude(-125, -70)
            ]);

            $drop = Coordinate::create([
                'latitude' => fake()->latitude(30, 50),
                'longitude' => fake()->longitude(-125, -70)
            ]);

            $currentLocation = null;

            Delivery::create([
                'pickup_point_coordinate_id' => $pickup->id,
                'drop_point_coordinate_id' => $drop->id,
                'current_location_coordinate_id' => $currentLocation?->id,
                'generated_route_id' => null,
            ]);
        }
    }
}
