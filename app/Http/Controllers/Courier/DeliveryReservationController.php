<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use Nette\NotImplementedException;
use App\Http\Controllers\Controller;

class DeliveryReservationController extends Controller
{
    public function index()
    {
        $deliveries = DeliveryController::getAvailable();
        return view('courier.delivery-exploring',  compact('deliveries'));
    }

    public function show($id)
    {
        $delivery = \App\Models\Delivery::with(['pickupPoint', 'dropPoint', 'currentLocation'])->findOrFail($id);

        return view('courier.delivery-info', compact('delivery'));
    }
}
