<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Http\Controllers\Controller;

class RouteGeneratingController extends Controller
{
    // TODO_MANFREDAS_LAMSARGIS
    public static function generate(Delivery $delivery)
    {
        // Simulate async generation (fake delay, job dispatching, etc.)
        logger("Route generation triggered for delivery ID {$delivery->id}");

        // Here you'd normally dispatch a Job or start async logic
        // For now, it's a placeholder
    }
}
