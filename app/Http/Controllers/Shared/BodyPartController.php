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
use App\Models\Delivery;
use App\Models\Coordinate;
use App\Enums\AuctionStatus;

class BodyPartController extends Controller
{
    public static function checkBodyPartExpiration($offerId)
    {
        $offer = BodyPartOffer::findOrFail($offerId);

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

        return back()->with('message', 'Body part offer reserved successfully.');
    }

    public function redirectToAuction($offerId)
    {
        // 13
        $offer = BodyPartOffer::with('auction')->find($offerId);

        if (!$offer->auction) {
            return back()->with('message', 'This offer does not have an associated auction.');
        }

        // 15
        return redirect()->route('auctions.show', ['auction' => $offer->auction->id]);
    }

    public function buy($id)
    {
        $multiplier = 1.5;
        // 3
        $offer = BodyPartOffer::find($id);
        $price = $offer->price * $multiplier;
        
        // 5
        $canBuy = CryptoWalletController::getBalance(1, $price);
    
        if (!$canBuy) 
        {
            // 10-11
            return back()->with('message', 'Insufficient balance to buy this offer.');
        }
    
        $orderController = new OrderController();
        // 12
        $orderController->store($offer, $multiplier);
        
        // 16-17
        return back()->with([
            'offerId' => $id,
            'needsConfirmation' => true
        ]);
    }

    public function create()
    {
        $bodyPartTypes = BodyPartType::all();
        return view('Supplier.add_body_part_offer', compact('bodyPartTypes'));
    }

    public function index()
    {
        // 18
        $offers = BodyPartOffer::with('bodyPartType')
            ->join('body_part_types', 'body_part_offers.body_part_type_id', '=', 'body_part_types.id')
            ->where('body_part_offers.status', BodyPartOfferStatus::NOT_RESERVED)
            ->whereNotNull('body_part_offers.available_at')
            ->whereNotNull('body_part_types.expiration_period_minutes')
            ->whereRaw("
                body_part_offers.available_at + (body_part_types.expiration_period_minutes || ' minutes')::interval >= now()
            ")
            ->select('body_part_offers.*')
            ->get();

        // 20
        return view('Client.body_part_list', compact('offers'));
    }

    public function indexClient()
    {
        // 3
        $offers = BodyPartOffer::with('bodyPartType')
            ->join('body_part_types', 'body_part_offers.body_part_type_id', '=', 'body_part_types.id')
            ->where('body_part_offers.status', BodyPartOfferStatus::NOT_RESERVED)
            ->whereNotNull('body_part_offers.available_at')
            ->whereNotNull('body_part_types.expiration_period_minutes')
            ->whereRaw("
                body_part_offers.available_at + (body_part_types.expiration_period_minutes || ' minutes')::interval >= now()
            ")
            ->select('body_part_offers.*')
            ->get();

        // 5
        return view('Client.body_part_list', compact('offers'));
    }

    public function indexSupplier()
    {
        $offers = BodyPartOffer::with('bodyPartType')
            ->join('body_part_types', 'body_part_offers.body_part_type_id', '=', 'body_part_types.id')
            ->where('body_part_offers.status', BodyPartOfferStatus::NOT_ACCEPTED)
            ->whereNotNull('body_part_offers.available_at')
            ->whereNotNull('body_part_types.expiration_period_minutes')
            ->whereRaw("
                body_part_offers.available_at + (body_part_types.expiration_period_minutes || ' minutes')::interval >= now()
            ")
            ->select('body_part_offers.*')
            ->get();

        return view('Supplier.body_part_list', compact('offers'));
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

        return redirect()->route('body_part.showBodyPartOffers')->with('message', 'Body part offer created successfully');
    }
    
    public function show($id)
    {
        // 8
        $offer = BodyPartOffer::with('bodyPartType')->whereIn('status', [
            BodyPartOfferStatus::NOT_RESERVED,
            BodyPartOfferStatus::SOLD
        ])
        ->find($id);
        
        // 10
        return view('Client.body_part', compact('offer'));
    }

    public function agreeToBuy(Request $request, $id)
    {
        // 20
        $offer = BodyPartOffer::find($id);

        $amount = $offer->price * 1.5;
        
        // 22
        $paymentResult = CryptoWalletController::performPayment($amount);
    
        if ($paymentResult['success']) 
        {    
            // 25
            BodyPartOffer::findOrFail($id)->update([
                'status' => \App\Enums\BodyPartOfferStatus::SOLD
            ]);
            $orderController = new OrderController();
            // 27
            $orderController->updateStatus($offer, OrderStatus::IN_DELIVERY);

            // 31
            BodyPartController::createDelivery();

            return back()->with('message', 'Payment successful.');
        }
        else 
        {
            $orderController = new OrderController();
            // 34
            $orderController->updateStatus($offer, OrderStatus::CANCELED);
            return back()->with('message', 'Payment failed. Order cancelled');
        }
    }

    public static function createDelivery()
    {
        // Delivery creation
        $pickup = Coordinate::create([
            'latitude' => 54.89968425015072,
            'longitude' => 23.961933117768396
        ]);

        $pickup = Coordinate::find($pickup->id);
        $drop = Coordinate::create([
            'latitude' => 54.9205441510663, 
            'longitude' => 23.99381522946014
        ]);
        $drop = Coordinate::find($drop->id);
        Delivery::create([
            'pickup_point_coordinate_id' => $pickup->id,
            'drop_point_coordinate_id' => $drop->id,
            'current_location_coordinate_id' => null,
            'generated_route_id' => null,
        ]);
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
