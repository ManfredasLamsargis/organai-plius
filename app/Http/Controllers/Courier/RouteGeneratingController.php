<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Http\Controllers\Controller;
use App\Jobs\GenerateRoute;

class RouteGeneratingController extends Controller
{
    // TODO_MANFREDAS_LAMSARGIS
    public static function generate(Delivery $delivery)
    {
        logger("Fake route generation triggered for delivery ID {$delivery->id}");

        GenerateRoute::dispatch($delivery);

        logger("Fake route generated for delivery ID {$delivery->id}");
    }
}
