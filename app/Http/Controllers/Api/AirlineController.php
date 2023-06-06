<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\AirlineResource;
use App\Models\Airline;
use Validator;
use Illuminate\Http\JsonResponse;


class AirlineController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airlines = Airline::with(['flights', 'tickets'])->get();
        return $this->sendResponse(AirlineResource::collection($airlines), 'Airlines retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required|unique:airlines',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try {
            $airline = Airline::create($input);
        } catch (Exception $e) {
              
            return $this->sendError('Error Creating Airline Record.');
        }
        return $this->sendResponse(new AirlineResource($airline), 'Airline created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $airline = Airline::with(['flights', 'tickets'])->find($id);

        if (is_null($airline)) {
            return $this->sendError('Airline not found.');
        }

        return $this->sendResponse(new AirlineResource($airline), 'Airline retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airline $airline)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $airline->name = $input['name'];
        $airline->save();
   
        return $this->sendResponse(new AirlineResource($airline), 'Airline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airline $airline)
    {
        $airline->delete();
   
        return $this->sendResponse([], 'Airline deleted successfully.');
    }
}
