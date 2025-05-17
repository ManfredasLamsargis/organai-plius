<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boundaries\Courier\WorldMapPlatformAPI;
use Nette\NotImplementedException;
use App\Models\Delivery;

class DeliveryManagingController extends Controller
{
    public function index() 
    {
        //throw new NotImplementedException("TODO: Manfredas Lamsargis");
        $delivery = Delivery::where('responsible_courier_id', auth()->id())
                            ->whereNotIn('state', ['finished', 'cancelled'])
                            ->first();

        return view('delivery_manage.index', compact('delivery'));

        //CIA DALYKAI KAS PAS MANE BUVO, GAL PADES
    }

    public function startDelivery(Request $request)
    {
        $delivery = Delivery::findOrFail($request->input('delivery_id'));
        $delivery->update(['state' => 'in_progress']);

        ///TODO MANFREDAS
        ///IDETI ROUTE RODYMA

        return view('delivery_manage.started', compact('delivery'));
    }

    public function finishDelivery(Request $request)
    {
        
        $delivery = Delivery::findOrFail($request->input('delivery_id'));
        $delivery->update(['state' => 'delivered_unclaimed']);///Cia speju state = unclaimed buna kai atiduodi delivery ir paspaudi kad numetei organa prie kliento duru?

        return view('delivery_manage.finished', compact('delivery'));
    }

    public function cancelDelivery()
    {
        ///SITO NEREIKIA IMPLEMENTUOTI
        throw new NotImplementedException("TODO: Julius Barauskas");
    }

    public function viewDeliveryRoute()
    {
        throw new NotImplementedException("TODO: Manfredas Lamsargis");
    }

    public function refreshDeliveryRouteMap()
    {
        throw new NotImplementedException("TODO: Manfredas Lamsargis");
    }
}
