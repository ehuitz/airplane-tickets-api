<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class ApiController extends Controller
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'status' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'status' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }


    public function generateSeatNumber($flightId)
    {
        // Get all the used seat numbers for the given flight
    $usedSeatNumbers = Ticket::where('flight_id', $flightId)->pluck('seat')->toArray();

    // Generate a random seat number between 1 and 32 that has not been used
    $availableSeatNumbers = array_diff(range(1, 32), $usedSeatNumbers);
    
    if (empty($availableSeatNumbers)) {
       return 0;
    }
    $randomSeatNumber = array_rand($availableSeatNumbers);

    return $availableSeatNumbers[$randomSeatNumber];
    }
}
