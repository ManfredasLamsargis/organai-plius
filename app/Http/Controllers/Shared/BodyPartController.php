<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BodyPartOffer;
use App\Models\BodyPartType;
use App\Models\Auction;
use App\Enums\BodyPartOfferStatus;
use App\Http\Controllers\Client\CryptoWalletController;
use App\Http\Controllers\Shared\OrderController;
use App\Enums\OrderStatus;
use App\Enums\AuctionStatus;

class BodyPartController extends Controller
{
    public static function checkBodyPartExpiration($offerId)
    {
        $offer = BodyPartOffer::find($offerId);

        if (!$offer || !$offer->available_at) {
            return false;
        }

        $type = BodyPartType::find($offer->body_part_type_id);

        if (!$type || !$type->expiration_period_minutes) {
            return false;
        }

        $expirationTime = \Carbon\Carbon::parse($offer->available_at)
            ->addHours($type->expiration_period_minutes);

        return now()->greaterThanOrEqualTo($expirationTime);
    }

    public static function reserveBodyPart($offerId)
    {
        $offer = BodyPartOffer::findOrFail($offerId);
        $offer->status = BodyPartOfferStatus::RESERVED;
        $offer->last_updated_at = now();
        $offer->save();

        # 22 rename to save()

        return back()->with('message', 'Body part offer reserved successfully.');
    }

    public function redirectToAuction($offerId)
    {
        $offer = BodyPartOffer::with('auction')->findOrFail($offerId);

        if (!$offer->auction) {
            return back()->with('message', 'This offer does not have an associated auction.');
        }

        return redirect()->route('auctions.show', ['auction' => $offer->auction->id]);
    }

    public function buy($id)
    {
        $multiplier = 1.5;
        $offer = BodyPartOffer::findOrFail($id);
        $price = $offer->price * $multiplier;
    
        $canBuy = CryptoWalletController::getBalance(1, $price);
    
        if (!$canBuy) {
            return back()->with('message', 'Insufficient balance to buy this offer.');
        }
    
        $orderController = new OrderController();
        $orderController->store($offer, $multiplier);
        
        return back()->with([
            'offerId' => $id,
            'needsConfirmation' => true
        ]);
        //return back()->with('message', 'Order created. Proceed to payment.');
    }

    public function create()
    {
        $bodyPartTypes = BodyPartType::all();
        return view('Supplier.add_body_part_offer', compact('bodyPartTypes'));
    }

    public function index()
    {
        $offers = BodyPartOffer::with('bodyPartType')
        ->where('status', BodyPartOfferStatus::NOT_RESERVED)
        ->get();

        return view('Client.body_part_list', compact('offers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'available_at' => 'required|date',
            'description' => 'required|string',
            'body_part_type_id' => 'required|exists:body_part_types,id',
        ]);
    
        $validated['status'] = BodyPartOfferStatus::NOT_ACCEPTED; // Default
        $validated['last_updated_at'] = now();
    
        BodyPartOffer::create($validated);
        Auction::create([
            'minimum_bid' => $validated['price'] + 1,
            'start_time' => now(),
            'end_time' => now()->addHour(),
            'status' => AuctionStatus::NOT_STARTED,
            'participant_count' => 0
        ]);

        return redirect()->back()->with('message', 'Body part offer created successfully.');
    }
    
    public function show($id)
    {
        $offer = BodyPartOffer::with('bodyPartType')
        ->where('status', BodyPartOfferStatus::NOT_RESERVED)
        ->findOrFail($id);

        return view('Client.body_part', compact('offer'));
    }

    public function agreeToBuy(Request $request, $id)
    {
        $offer = BodyPartOffer::findOrFail($id);
        $amount = $offer->price * 1.5;
    
        $paymentResult = CryptoWalletController::performPayment($amount);
    
        if ($paymentResult['success']) {
            $orderController = new OrderController();
            $orderController->updateStatus($offer, OrderStatus::IN_DELIVERY);

            return back()->with('message', 'Payment successful.');
        }
    
        return back()->with('message', 'Payment failed.');
    }

    public static function updateToSold(BodyPartOffer $offer)
    {
        $offer->status = BodyPartOfferStatus::SOLD;
        $offer->last_updated_at = now();
        $offer->save();
    }

    public static function unreserve(BodyPartOffer $offer)
    {
        $offer->status = BodyPartOfferStatus::NOT_RESERVED;
        $offer->last_updated_at = now();
        $offer->save();
    }
}
