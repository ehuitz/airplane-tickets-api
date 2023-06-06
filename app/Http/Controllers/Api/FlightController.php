<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController as ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use Validator;
use Illuminate\Http\JsonResponse;

class FlightController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::with(['airline', 'tickets'])->get();
        return $this->sendResponse(FlightResource::collection($flights), 'Flights retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'airline_id' => 'required|exists:airlines,id',
            'source' => 'required',
            'destination' => 'required',
            'departure_time' => 'required|date_format:Y-m-d H:i:s'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try {
            $flight = Flight::create($input);
        } catch (Exception $e) {
              
            return $this->sendError('Error Creating Flight Record.');
        }
        return $this->sendResponse(new FlightResource($flight), 'Flight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $flight = Flight::with(['airline', 'tickets'])->find($id);

        if (is_null($flight)) {
            return $this->sendError('Flight not found.');
        }

        return $this->sendResponse(new FlightResource($flight), 'Flight retrieved successfully.');
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'airline_id' => 'nullable|exists:airlines,id',
            'source' => 'nullable',
            'destination' => 'nullable',
            'departure_time' => 'nullable|date_format:Y-m-d H:i:s'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if($input['airline_id']){
            $flight->airline_id = $input['airline_id'];
        }
        if($input['source']){
            $flight->source = $input['source'];
        }
        if($input['destination']){
            $flight->destination = $input['destination'];
        }
        if($input['departure_time']){
            $flight->departure_time = $input['departure_time'];
        }
        
        $flight->save();
   
        return $this->sendResponse(new FlightResource($flight), 'Flight updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
   
        return $this->sendResponse([], 'Flight deleted successfully.');
    }
}
