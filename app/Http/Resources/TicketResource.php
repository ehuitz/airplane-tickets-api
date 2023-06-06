<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ticket;
use App\Models\Flight;
use App\Http\Resources\FlightResource;
use App\Http\Resources\AirlineResource;

 

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $flight = $this->whenLoaded('flight');
        $airline = $this->whenLoaded('airline');


        return [
            'id' => $this->id,
            'holder_name' => $this->holder_name,
            'passport_number' => $this->passport_number,
            'seat' => $this->seat,
            'flight' => new FlightResource($flight),
            'airline' => new AirlineResource($airline),
        ];
    }
}
