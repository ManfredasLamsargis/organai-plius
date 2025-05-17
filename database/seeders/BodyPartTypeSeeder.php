<?php

namespace Database\Seeders;

use App\Models\BodyPartType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodyPartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BodyPartType::factory()->count(5)->create();
    }
}
