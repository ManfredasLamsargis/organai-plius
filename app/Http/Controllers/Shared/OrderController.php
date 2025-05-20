<?php

namespace App\Http\Controllers\Shared;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;
use App\Models\BodyPartOffer;
use App\Models\Delivery;
use App\Enums\DeliveryState;
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

    public function index()
    {
        $orders = Order::with('bodyPartOffer')
                    ->get();
        
        return view('Client.orders', compact('orders'));
    }


    public function show($id)
    {
        $order = Order::with('bodyPartOffer.bodyPartType')
                    ->findOrFail($id);
        
        return view('Client.order', compact('order'));
    }


    public function finishOrder($id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->status !== OrderStatus::IN_DELIVERY) {
            return back()->with('error', 'Pristatymas gali būti patvirtintas tik kai užsakymas yra pristatymo būsenoje.');
        }
        
        $order->status = OrderStatus::COMPLETED;
        $order->save();

        MarkDeliveryDone($id);
    }

    public function MarkDeliveryDone($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->state = DeliveryState::Delivered_Claimed;
        $delivery->save();
    }
}
