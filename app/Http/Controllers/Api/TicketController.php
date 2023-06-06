<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Http\Resources\TicketResource;
use Validator;
use Illuminate\Http\JsonResponse;

class TicketController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['flight', 'airline'])->get();
        return $this->sendResponse(TicketResource::collection($tickets), 'Tickets retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'flight_id' => 'required|exists:flights,id',
            'holder_name' => 'required',
            'passport_number' => 'required'
        ]);



        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }




        try {
            $seat_number = $this->generateSeatNumber($input['flight_id']);
            if($seat_number==0){
                return $this->sendError('There are no more available seat in this flight.');
            }

            $ticket = new Ticket;

            $ticket->flight_id = $input['flight_id'];
            $ticket->holder_name = $input['holder_name'];
            $ticket->passport_number = $input['passport_number'];
            $ticket->seat = $seat_number;
            $ticket->save();

        } catch (Exception $e) {

            return $this->sendError('Error Creating Ticket Record.');
        }
        return $this->sendResponse(new TicketResource($ticket), 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::find($id);

        if (is_null($ticket)) {
            return $this->sendError('Flight not found.');
        }

        return $this->sendResponse(new TicketResource($ticket->loadMissing(['flight', 'airline'])), 'Ticket retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'flight_id' => 'nullable|exists:flights,id',
            'holder_name' => 'nullable',
            'passport_number' => 'nullable',
            'update_seat' => 'required|boolean'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }



        if($input['update_seat'])
        {
            try {
                $ticket->seat = null;
                $ticket->save();

                } catch (Exception $e) {

                    return $this->sendError('Error Updating Ticket Record.');
                }

            $seat_number = $this->generateSeatNumber($input['flight_id']);
            $ticket->seat = $seat_number;

            if($seat_number==0){
                return $this->sendError('There are no more available seat in this flight.');
            }
        }



        if($input['flight_id']){
            $ticket->flight_id = $input['flight_id'];
        }
        if($input['holder_name']){
            $ticket->holder_name = $input['holder_name'];
        }
        if($input['passport_number']){
            $ticket->passport_number = $input['passport_number'];
        }

        try {
            $ticket->save();

        } catch (Exception $e) {

        return $this->sendError('Error Updating Ticket Record.');
    }

        return $this->sendResponse(new TicketResource($ticket), 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return $this->sendResponse([], 'Ticket deleted successfully.');
    }
}
