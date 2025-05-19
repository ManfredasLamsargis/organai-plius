<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Http\Controllers\Controller;
use App\Jobs\GenerateRoute;
use App\Models\RoadNode;
use App\Models\RoadEdge;

class RouteGeneratingController extends Controller
{
    // TODO_MANFREDAS_LAMSARGIS
    public static function generate(Delivery $delivery)
    {
        $start = $delivery->pickupPoint;
        $end = $delivery->dropPoint;

        $startNode = RoadNode::findNearestTo($start->latitude, $start->longitude);
        $endNode = RoadNode::findNearestTo($end->latitude, $end->longitude);

        $path = RouteController::findOptimalPath($startNode->id, $endNode->id);

        RouteController::storePath($delivery, $path);

        return $path;
    }
}
