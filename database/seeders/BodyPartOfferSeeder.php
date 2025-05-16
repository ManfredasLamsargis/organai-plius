<?php

namespace Database\Seeders;

use App\Models\BodyPartOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodyPartOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BodyPartOffer::factory()->count(5)->create();
    }
}
