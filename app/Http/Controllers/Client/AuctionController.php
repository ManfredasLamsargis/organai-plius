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
        if ($auction->status === AuctionStatus::CANCELED || $auction->status === AuctionStatus::WON) 
        {
            return response()->json([
                'enough' => false,
                'message' => 'This auction is no longer valid.'
            ]);
        }

        // $request->validate([
        //     'bid_amount' => 'required|numeric|min:' . $auction->minimum_bid,
        // ]);

        $bidAmount = (float) $request->input('bid_amount');
        if (!CryptoWalletController::getBalance(1, $bidAmount)) {
            return response()->json([
                'enough' => false,
                'message' => 'Your crypto balance is too low.'
            ]);
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
                else
                {
                    // bid too small
                    return response()->json([
                        'enough' => false,
                        'message' => 'Your bid is too small.'
                    ]);
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
        
        // if (BodyPartController::checkBodyPartExpiration($auction->body_part_offer_id)) 
        // {
        //     // Expired
        //     AuctionController::cancelAuction($auction);

        //     return response()->json([
        //         'enough' => false,
        //         'message' => 'The body part offer has expired. The auction has been canceled.'
        //     ]);


        // } 

        $response = AuctionController::handleAuction($auction);
        if ($response) return $response;


        // Not expired
        



        return response()->json([
            'enough' => false,
            'message' => 'The end of method.'
        ]);
    }

    public static function cancelAuction(Auction $auction)
    {
        $auction->status = AuctionStatus::CANCELED;
        $auction->save();
    }

    public static function handleAuction(Auction $auction, bool $isTriggeredByUser = true)
    {
        // if (BodyPartController::checkBodyPartExpiration($auction->body_part_offer_id)) 
        // {
        //     // Expired
        //     // 35
        //     AuctionController::cancelAuction($auction);
            
        //     // 38-39
        //     return response()->json([
        //         'enough' => false,
        //         'message' => 'The body part offer has expired. The auction has been canceled.'
        //     ]);
        // }

        // body part is valid
        if (AuctionController::isTriggeredByTimeOrBid($auction, $isTriggeredByUser))
        {
            // triggered by time event
            return response()->json([
                'enough' => false,
                'message' => 'TRIGGERED BY TIME EVENT'
            ]);
        }
        else
        {
            // For now it is static since we do not have auth
            $auction->leader_id = 1;
            $auction->end_time = \Carbon\Carbon::parse($auction->end_time)->addMinutes(30);
            // 41
            $auction->save();

            // triggered by user
            // 43-44
            return response()->json([
                'enough' => true,
                'message' => 'New bid accepted and registered successfully.'
            ]);
        }
    }

    // Return false - triggered by user
    // Return true - triggered by time event
    public static function isTriggeredByTimeOrBid(Auction $auction, bool $isTriggeredByUser = true)
    {
        if ($isTriggeredByUser) {
            return false;
        }

        // Auction time expired
        if (isset($auction->ends_at) && now()->greaterThanOrEqualTo($auction->ends_at)) {
            return true;
        }

        return false;
    }

    public static function checkAuction()
    {
        // Working code
        $activeAuctions = Auction::where('status', AuctionStatus::ACTIVE)->get();

        foreach ($activeAuctions as $auction) 
        {
            AuctionController::handleAuction($auction, false);
                //$auction->status = AuctionStatus::WON;
                //$auction->save();
        }



        
    }

}