<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionResource;
use App\Http\Resources\PetitionCollection;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
	$petitions = Petition::all();

//	return PetitionResource::collection($petitions);
//	return new PetitionCollection($petitions);
	return response()->json(new PetitionCollection($petitions), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
	$petition = Petition::create($request->only([
		'title', 'description', 'category', 'author', 'signees'
	]));

	return new PetitionResource($petition);
    }

    /**
     * Display the specified resource.
     */
    public function show(Petition $petition)
    {
        //
	  return new PetitionResource($petition);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petition $petition)
    {
        //
	    $petition->update($request->only([
		'title', 'description', 'category', 'author', 'signees'
	]));
	   
	    return new PetitionResource($petition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petition $petition)
    {
        //
	    $petition->delete();

	    return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
