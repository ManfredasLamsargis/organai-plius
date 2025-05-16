<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodyPartOffer;
use App\Models\Auction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = BodyPartOffer::where('state', 'not_accepted')->get();
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
        $supplier_offer->update(['state' => 'accepted']);

        // 2. Create related auction
        Auction::create([
            'body_part_offer_id' => $supplier_offer->id,
            'minimal_bid' => $supplier_offer->price, // or adjust logic here
            'state' => 'not_reserved',
            'start_time' => now(),
            'finish_time' => now()->addHours(24) // optional
        ]);

        //return redirect()->route('supplier-offers.index')->with('message', 'Offer accepted and auction created.');

        $offers = BodyPartOffer::where('state', 'not_accepted')->get();
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
