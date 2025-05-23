<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodyPartType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BodyPartTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodyPartTypes = BodyPartType::all();
        return view('body_part_type.index')->with('bodyPartTypes', $bodyPartTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // take an object containing the post's title and body and
        // validate the data
        $request->validate([
            'name' => 'required|max:255',
            'expiration_period_minutes' => 'required',
            'description' => 'required',
        ]);

        // add a new body part type to the database
        BodyPartType::create($request->all());

        // redirect to the body part type homepage with a success message
        return response()
                ->redirectToRoute('body_part_type.index')
                ->with('message', 'New body part type created.');
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('body_part_type.create');
    }


    public function edit(BodyPartType $bodyPartType)
    {
        return response()
                    ->view('body_part_type.edit', ['bodyPartType' => $bodyPartType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int 
     * @return \Illuminate\Http\Response
     */
    public function show(BodyPartType $bodyPartType)
    {
        return response()
                    ->view('body_part_type.show', ['bodyPartType' => $bodyPartType]);
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
        $request->validate([
            'name' => 'required|unique:body_part_types,name,' . $id,
            'expiration_period_minutes' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);
        $bodyPartType = BodyPartType::find($id);

        $bodyPartType->update($request->only([
            'name',
            'expiration_period_minutes',
            'description'
        ]));
    
        return redirect()->route('body_part_type.index')->with('message','Body part type updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bodyPartType = BodyPartType::find($id);
        $bodyPartType->delete();
        return response()
                ->redirectToRoute('body_part_type.index')
                ->with('message','Body part deleted.');
    }    
}
