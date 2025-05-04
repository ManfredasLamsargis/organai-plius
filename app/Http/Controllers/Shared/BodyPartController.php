<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BodyPartOffer;
use App\Models\BodyPartType;
use App\Enums\BodyPartOfferStatus;

class BodyPartController extends Controller
{
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
    
        return redirect()->back()->with('message', 'Body part offer created successfully.');
    }
    
    public function show($id)
    {
        $offer = BodyPartOffer::with('bodyPartType')
        ->where('status', BodyPartOfferStatus::NOT_RESERVED)
        ->findOrFail($id);

        return view('Client.body_part', compact('offer'));
    }

}
