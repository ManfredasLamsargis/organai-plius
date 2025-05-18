<?php

namespace App\Http\Controllers\Courier;

use App\Enums\DeliveryState;
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
        $delivery = DeliveryController::find($id);

         $routeCoordinates = $delivery->route
        ? $delivery->route->coordinates()->orderBy('id')->get(['latitude', 'longitude'])
        : collect();

         return view('courier.delivery-info', compact('delivery', 'routeCoordinates'));
    }

    public function reserve($id)
    {
        $delivery = DeliveryController::find($id);
        $delivery->state = DeliveryState::ReservedForGeneration;

        DeliveryController::update($delivery);

        // TODO_MANFREDAS_LAMSARGIS: no concurrency here, why it needs to be so hard, I want to go back to C++ :(
        $generatedPath = RouteGeneratingController::generate($delivery);

        return redirect()
            ->route('courier.delivery.info', ['id' => $id])
            ->with('message', 'Delivery accepted. Route generated.');
    }
}
