<?php
namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use Nette\NotImplementedException;
use App\Models\Delivery;

class DeliveryController extends Controller
{
  public static function getAvailable()
  {
    $deliveries = Delivery::with([
        'pickupPoint',
        'dropPoint',
        'currentLocation'
    ])->get();

    return $deliveries;
  }

  public static function find($id)
  {
    $delivery = Delivery::with(['pickupPoint', 'dropPoint', 'currentLocation'])->findOrFail($id);
    return $delivery;
  }
}