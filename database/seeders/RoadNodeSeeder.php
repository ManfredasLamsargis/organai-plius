<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadNodeSeeder extends Seeder
{
    public function run()
    {
        $file = storage_path('app/public/Data/Kaunas/nodes.csv');
        $handle = fopen($file, 'r');

        $headers = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            if (!is_numeric($data['osmid'])) continue;

            DB::table('road_nodes')->updateOrInsert([
                'id' => $data['osmid'],
            ], [
                'latitude' => $data['y'],
                'longitude' => $data['x'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($handle);
    }
}
