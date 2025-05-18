<?php

namespace App\Http\Controllers\Client;

use App\Models\BodyPartOffer;
use App\Models\Auction;
use App\Models\Bid;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\BodyPartController;
use App\Http\Controllers\Shared\OrderController;
use Illuminate\Http\Request;
use App\Enums\AuctionStatus;
use App\Enums\AuctionTriggerType;
use App\Enums\OrderStatus;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::with('bodyPartOffer')
            ->where('status', AuctionStatus::ACTIVE)
            ->get();

        return view('Client.auction_list', compact('auctions'));
    }

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

        $auction->minimum_bid = $bidAmount;
        $auction->save();
    }

    // 5
    public function checkBidBalance(Request $request, Auction $auction)
    {
        if ($auction->status === AuctionStatus::CANCELED || $auction->status === AuctionStatus::WON) 
        {
            return response()->json([
                'enough' => false,
                'message' => 'This auction is no longer valid.'
            ]);
        }

        $bidAmount = (float) $request->input('bid_amount');
        // 6
        if (!CryptoWalletController::getBalance(1, $bidAmount)) 
        {
            // 73-74
            return response()->json([
                'enough' => false,
                'message' => 'Your crypto balance insufficient'
            ]);
        }
        
        // Balance sufficient

        // 11
        $response = $this->checkState($auction); 
        $data = $response->getData(true);

        $newBid = true;

        if ($data['is_active']) 
        {
            // If auction is active
            // 12
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
                    // 14-15
                    return response()->json([
                        'enough' => false,
                        'message' => 'Your bid is too small.'
                    ]);
                }
            }
        }
        
        // Auction is inactive
        // 16
        BodyPartController::reserveBodyPart($auction->body_part_offer_id);

        $auction->status = AuctionStatus::ACTIVE;
        // 20
        $auction->save();

        // 22
        AuctionController::handleBid($auction, $newBid, $bidAmount);

        // 24
        $response = AuctionController::handleAuction($auction);
        if ($response) return $response;

        return;
    }

    public static function cancelAuction(Auction $auction)
    {
        $auction->status = AuctionStatus::CANCELED;
        $auction->save();
    }

    public static function handleAuction(Auction $auction, bool $isTriggeredByUser = true)
    {
        // 27
        if (BodyPartController::checkBodyPartExpiration($auction->body_part_offer_id)) 
        {
            // Expired
            // 33
            AuctionController::cancelAuction($auction);
            
            // 36-37
            return response()->json([
                'enough' => false,
                'message' => 'The body part offer has expired. The auction has been canceled.'
            ]);
        }

        // body part is valid
        // 38
        $triggerType = AuctionController::isTriggeredByTimeOrBid($auction, $isTriggeredByUser);
        if ($triggerType == AuctionTriggerType::TIME) // time has run out for the next bid
        {
            // 43
            $bodyPartOffer = BodyPartOffer::find($auction->body_part_offer_id);
            $orderController = new OrderController();
            // 45
            $orderController->store($bodyPartOffer);
            // 49
            $paymentResult = CryptoWalletController::performPayment($auction->minimum_bid);
            
            // Payment successful
            if ($paymentResult['success'])
            {
                $orderController = new OrderController();
                // 50
                $orderController->updateStatus($bodyPartOffer, OrderStatus::IN_DELIVERY);
                // 55
                BodyPartController::updateToSold($bodyPartOffer);

                $auction->status = AuctionStatus::WON;
                // 59
                $auction->save();

                // 61-62
                return back()->with('message', 'Payment successful. You won the auction!');
            }
            else // Payment unsuccessful
            {
                $auction->status = AuctionStatus::NOT_STARTED;
                // 63
                $auction->save();
                $orderController = new OrderController();
                // 65
                $orderController->updateStatus($bodyPartOffer, OrderStatus::CANCELED);
                // 69
                BodyPartController::unreserve($bodyPartOffer);

                // 73-74
                return response()->json([
                    'enough' => false,
                    'message' => 'Payment unsuccessful'
                ]);
            }
        }
        else if ($triggerType == AuctionTriggerType::USER) // new bid
        {
            // For now it is static since we do not have an auth
            $auction->leader_id = 1;
            //$auction->end_time = \Carbon\Carbon::parse($auction->end_time)->addMinutes(30);
            $auction->end_time = now()->addMinutes(30);
            // 39
            $auction->save();

            // triggered by user
            // 41-42
            return response()->json([
                'enough' => true,
                'message' => 'New bid accepted and registered successfully.'
            ]);
        }
        else
        {
            return;
        }
    }

    // Return false - triggered by user
    // Return true - triggered by time event
    public static function isTriggeredByTimeOrBid(Auction $auction, bool $isTriggeredByUser = true)
    {
        if ($isTriggeredByUser) 
        {
            return AuctionTriggerType::USER;
        }

        // Auction time expired
        if (isset($auction->end_time) && now()->greaterThanOrEqualTo($auction->end_time)) 
        {
            return AuctionTriggerType::TIME;
        }

        return AuctionTriggerType::SKIP;
    }

    public static function checkAuction()
    {
        $activeAuctions = Auction::where('status', AuctionStatus::ACTIVE)->get();

        foreach ($activeAuctions as $auction) 
        {
            AuctionController::handleAuction($auction, false);
        }
    }
}