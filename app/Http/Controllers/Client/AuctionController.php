<?php

namespace App\Http\Controllers\Client;

use App\Models\Auction;
use App\Models\Bid;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\BodyPartController;
use Illuminate\Http\Request;
use App\Enums\AuctionStatus;

class AuctionController extends Controller
{
    public function show($id)
    {
        $auction = Auction::with('bodyPartOffer')->findOrFail($id);
        return view('Client.auction', compact('auction'));
    }

    public function checkState(Auction $auction)
    {
        return response()->json([
            'is_active' => $auction->status === AuctionStatus::ACTIVE,
        ]);
    }

    public static function handleBid(Auction $auction, bool $newBid, float $bidAmount)
    {
        if ($newBid)
        {
            // Create bid 27-28
            Bid::create([
                'date' => now(),
                'amount' => $bidAmount,
                'auction_id' => $auction->id,
            ]);
        }
        else
        {
            $bid = Bid::where('auction_id', $auction->id)->first();
            $bid->update([
                'amount' => $bidAmount
            ]);
        }
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
        
        //return response()->json(['enough' => true]);
        
        $response = $this->checkState($auction); 
        $data = $response->getData(true);

        $newBid = true;

        if ($data['is_active']) 
        {
            // If auction is active
            
            // 15-16
            $bid = Bid::where('auction_id', $auction->id)->first();

            if ($bid)
            {
                if ($bidAmount > $bid->amount)
                {
                    $newBid = false;
                }
            }

            //return response()->json(['enough' => false]);
        }
        


        // Auction is inactive
        // TODO: uncomment
        //BodyPartController::reserveBodyPart($auction->body_part_offer_id);

        // 25-26
        $auction->status = AuctionStatus::ACTIVE;
        // Rename 25 to save()
        $auction->save();

        // Create bid 27-28
        // Bid::create([
        //     'date' => now(),
        //     'amount' => $bidAmount,
        //     'auction_id' => $auction->id,
        // ]);

        AuctionController::handleBid($auction, $newBid, $bidAmount);
        


        return response()->json(['enough' => true]);
    }

    public static function checkBodyPartExpiration()
    {
        // Working code
        // $activeAuctions = Auction::where('status', AuctionStatus::ACTIVE)->get();

        // foreach ($activeAuctions as $auction) {
        //     if ($auction->ends_at <= now()) {
        //         $auction->status = AuctionStatus::WON;
        //         $auction->save();
        //     }
        // }

        
    }

}