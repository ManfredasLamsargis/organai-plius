<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryManagingController extends Controller
{
    public function index()
    {
        // Assume each courier has only one active delivery (simplified) hihohihooohohohohoo
        //cia turetu paimt tik ta delivery kuris priklauso kurjeriui, dabar visus is eiles po viena ima mhmhmmh ueueue
        $delivery = Delivery::where('responsible_courier_id', auth()->id())
            ->whereNotIn('state', ['finished', 'cancelled'])
            ->first();

        if (!$delivery) {
            return view('delivery_manage.index', compact('delivery'));
        }

        return view('delivery_manage.index', compact('delivery'));
    }

    public function start(Request $request)
    {
        $delivery = Delivery::findOrFail($request->input('delivery_id'));
        $delivery->update(['state' => 'in_progress']);

        return view('delivery_manage.started', compact('delivery')); ////nuu cia turetu grazint kita viewsa kuriame butu mapsas deliverio ueueue
    }

    public function finish(Request $request)
    {
        $delivery = Delivery::findOrFail($request->input('delivery_id'));
        $delivery->update(['state' => 'finished']);
        //todododo ??? informuoti klienta apie sekminga delivery
        return view('delivery_manage.finished', compact('delivery'));
    }
}
