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
        $delivery = DeliveryController::find($id);

        return view('courier.delivery-info', compact('delivery'));
    }

    public function reserve($id)
    {
        DeliveryController::update($id);

        $delivery = DeliveryController::find($id);

        // Does it wait here or what?
        RouteGeneratingController::generate($delivery);

        return redirect()
            ->route('courier.delivery.info', ['id' => $id])
            ->with('message', 'Delivery accepted. Route is being generated...');
    }
}
