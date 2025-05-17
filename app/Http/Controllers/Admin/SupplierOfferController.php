<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodyPartOffer;
use App\Models\Auction;
use App\Http\Controllers\Client\AuctionController;
use App\Http\Controllers\Controller;
use App\Models\BodyPartType;
use Illuminate\Http\Request;
use App\Enums\BodyPartOfferStatus;
use App\Enums\AuctionStatus;

class SupplierOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = BodyPartOffer::where('status', BodyPartOfferStatus::NOT_ACCEPTED)->get();
        return view('supplier_offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BodyPartOffer $supplier_offer)
    {
        return response()
            ->view('supplier_offer.show', compact('supplier_offer'));
    }


    public function accept(BodyPartOffer $supplier_offer)
    {
        // 1. Update state of offer
        $supplier_offer->update(['status' => BodyPartOfferStatus::NOT_RESERVED]);

        // 2. Create related auction


        Auction::create([
            'minimum_bid' => $supplier_offer['price'] + 1,
            'start_time' => now(),
            'end_time' => now()->addHour(),
            'status' => AuctionStatus::NOT_STARTED,
            'participant_count' => 0,
            'body_part_offer_id' => $supplier_offer->id
        ]);

        
        //return redirect()->route('supplier-offers.index')->with('message', 'Offer accepted and auction created.');

        $offers = BodyPartOffer::where('status', BodyPartOfferStatus::NOT_ACCEPTED)->get();
        return view('supplier_offer.index', [
        'offers' => $offers,
        'message' => 'Offer accepted and auction created.'
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
