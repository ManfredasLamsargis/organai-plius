<?php

namespace App\Http\Controllers\Client;

use App\Models\Auction;
use App\Models\Bid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function show($id)
    {
        $auction = Auction::with('bodyPartOffer')->findOrFail($id);
        return view('Client.auction', compact('auction'));
    }

    public function checkBidBalance(Request $request, Auction $auction)
    {
        $request->validate([
            'bid_amount' => 'required|numeric|min:' . $auction->minimum_bid,
        ]);

        $bidAmount = (float) $request->input('bid_amount');

        if (!CryptoWalletController::getBalance(1, $bidAmount)) {
            return response()->json(['enough' => false]);
        }

        return response()->json(['enough' => true]);
    }
}