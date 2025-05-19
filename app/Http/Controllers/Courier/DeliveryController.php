<?php
namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Nette\NotImplementedException;
use App\Models\Delivery;
use App\Enums\DeliveryState;
use App\Http\Controllers\Courier\RouteGeneratingController;

class DeliveryController extends Controller
{
  public static function getAvailable()
  {
    $deliveries = Delivery::with([
        'pickupPoint',
        'dropPoint',
        'currentLocation'
    ])->where('state', DeliveryState::Unaccepted)->get();

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

}