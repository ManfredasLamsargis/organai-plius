<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\RoadNode;
use App\Models\RoadEdge;
use App\Models\Route;
use App\Models\Coordinate;
use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    /**
     * Run A* and return list of node IDs forming the path
     */
    public static function findOptimalPath(int $startId, int $endId): ?array
    {
        // TODO_MANFREDAS_LAMSARGIS: implement A* algorithm
        return null;
    }

    /**
     * Create route + save its coordinates for the delivery
     */
    public static function storePath(Delivery $delivery, array $nodeIds): void
    {
        DB::transaction(function () use ($delivery, $nodeIds) {
            $route = Route::create([
                'state' => 0, // placeholder, enum later
            ]);

            foreach ($nodeIds as $nodeId) {
                $node = RoadNode::find($nodeId);
                Coordinate::create([
                    'route_id' => $route->id,
                    'latitude' => $node->latitude,
                    'longitude' => $node->longitude,
                ]);
            }

            $delivery->generated_route_id = $route->id;
            $delivery->save();
        });
    }
}
