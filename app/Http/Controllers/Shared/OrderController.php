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
}
