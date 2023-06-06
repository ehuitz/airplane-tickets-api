<?php

namespace App\Services\Flight;

use Carbon\Carbon;
use App\Models\Flight;

class FlightService{

    public function getFlightsByDepartureDate($departureDate)
    {
        $departureDate = Carbon::createFromFormat('Y-m-d', $departureDate)->startOfDay();

        $flights = Flight::with(['airline', 'tickets'])
            ->whereDate('departure_time', $departureDate)
            ->get();

        return $flights;
    }
}


