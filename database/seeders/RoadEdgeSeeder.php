<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoadEdgeSeeder extends Seeder
{
    public function run()
    {
        $file = storage_path('app/public/Data/Kaunas/edges.csv');
        $handle = fopen($file, 'r');

        $headers = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($headers, $row);

            // Skip if missing IDs or badly formatted
            if (!is_numeric($data['u']) || !is_numeric($data['v'])) continue;

            DB::table('road_edges')->insert([
                'from_id' => $data['u'],
                'to_id' => $data['v'],
                'weight' => $data['length'] ?? 1.0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($handle);
    }
}
