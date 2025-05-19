<?php

namespace App\Http\Controllers\Shared;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;
use App\Models\BodyPartOffer;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(BodyPartOffer $offer, float $multiplier = 1)
    {
        $price = $offer->price * $multiplier;

        // 13
        return Order::create([
            'total_price' => $price,
            'status' => OrderStatus::UNPAID,
            'body_part_offer_id' => $offer->id,
        ]);
    }

    public function create()
    {
        return view('orders.create');
    }

    public function updateStatus(BodyPartOffer $offer, OrderStatus $newStatus)
    {
        $order = Order::where('body_part_offer_id', $offer->id)
                      ->latest()
                      ->first();
    
        if ($order) {
            $order->status = $newStatus;
            $order->save();
        }
    
        return $order;
    }

/**
 * Display a listing of client orders.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        $orders = Order::with('bodyPartOffer')
                    ->get();
        
        return view('Client.orders', compact('orders'));
    }

/**
 * Display the specified order.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id)
    {
        $order = Order::with('bodyPartOffer.bodyPartType')
                    ->findOrFail($id);
        
        return view('Client.order', compact('order'));
    }

/**
 * Confirm delivery of the order.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function confirmDelivery($id)
    {
        $order = Order::findOrFail($id);
        
        // Tikrinti ar užsakymas yra tinkamoje būsenoje
        if ($order->status !== OrderStatus::IN_DELIVERY) {
            return back()->with('error', 'Pristatymas gali būti patvirtintas tik kai užsakymas yra pristatymo būsenoje.');
        }
        
        // Atnaujinti užsakymo būseną į užbaigtą
        $order->status = OrderStatus::COMPLETED;
        $order->save();
        
        return redirect()->route('orders.index')
                        ->with('message', 'Pristatymas sėkmingai patvirtintas!');
    }
}
