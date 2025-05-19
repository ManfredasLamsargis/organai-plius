<?php
namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Nette\NotImplementedException;
use App\Models\Delivery;
use App\Enums\DeliveryState;
use App\Models\Route;
use App\Http\Controllers\Courier\RouteGeneratingController;

class DeliveryController extends Controller
{
  public static function getAvailable()
  {
    $deliveries = Delivery::getUnnaceptedDeliveries();
    return $deliveries;
  }

  public static function find($id)
  {
    $delivery = Delivery::with(['pickupPoint', 'dropPoint', 'currentLocation'])->findOrFail($id);
    return $delivery;
  }

  public static function update(Delivery $delivery)
  {
    $delivery->save();
    return true;
  }

  public function showRoute($id)
  {
      $delivery = DeliveryController::find($id);

      // assuming route and related coordinates already exist
      $route = $delivery->route;
      $routeCoordinates = $route ? $route->coordinates : [];

      return view('courier.delivery-route', compact('delivery', 'routeCoordinates'));
  }

  public function showLatestRoute()
  {
      $delivery = Delivery::whereHas('route') // ensure route exists
        ->where('state', \App\Enums\DeliveryState::NotStarted)
        ->with('route')
        ->orderByDesc(
            Route::select('created_at')
                ->whereColumn('routes.id', 'deliveries.generated_route_id')
                ->limit(1)
        )
        ->first();

      if (!$delivery) {
          return redirect()->route('courier.main')->with('message', 'No reserved deliveries available.');
      }

      $route = $delivery->route;
      $routeCoordinates = $route ? $route->coordinates : [];

      return view('courier.delivery-route', compact('delivery', 'routeCoordinates'));
  }

}