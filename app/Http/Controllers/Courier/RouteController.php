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
    public static function findOptimalPath(int $startId, int $goalId): ?array
    {
        $openSet = new \SplPriorityQueue();
        $openSet->insert($startId, 0);

        $cameFrom = [];
        $gScore = [$startId => 0];
        $fScore = [$startId => self::heuristic($startId, $goalId)];

        while (!$openSet->isEmpty()) {
            $current = $openSet->extract();

            if ($current === $goalId) {
                return self::reconstructPath($cameFrom, $current);
            }

            $neighbors = RoadEdge::where('from_id', $current)->get();

            foreach ($neighbors as $edge) {
                $tentativeG = $gScore[$current] + $edge->weight;

                if (!isset($gScore[$edge->to_id]) || $tentativeG < $gScore[$edge->to_id]) {
                    $cameFrom[$edge->to_id] = $current;
                    $gScore[$edge->to_id] = $tentativeG;
                    $fScore[$edge->to_id] = $tentativeG + self::heuristic($edge->to_id, $goalId);
                    $openSet->insert($edge->to_id, -$fScore[$edge->to_id]); // negative because SplPriorityQueue is max-heap
                }
            }
        }

        return null; // no route found
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

    protected static function heuristic(int $fromId, int $toId): float
    {
        $from = RoadNode::find($fromId);
        $to = RoadNode::find($toId);

        return sqrt(pow($from->latitude - $to->latitude, 2) + pow($from->longitude - $to->longitude, 2));
    }

    protected static function reconstructPath(array $cameFrom, int $current): array
    {
        $totalPath = [$current];

        while (isset($cameFrom[$current])) {
            $current = $cameFrom[$current];
            array_unshift($totalPath, $current);
        }

        return $totalPath;
    }
}
