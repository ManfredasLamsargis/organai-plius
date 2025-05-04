<?php

namespace App\Http\Controllers\Shared;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Enums\OrderStatus;
use App\Models\BodyPartOffer;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function store(BodyPartOffer $offer)
    {
        return Order::create([
            'total_price' => $offer->price,
            'status' => OrderStatus::UNPAID,
            'body_part_offer_id' => $offer->id,
        ]);
    }

    public function create()
    {
        return view('orders.create');
    }
}
