<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Flight;
use App\Models\Airline;
use App\Http\Resources\AirlineResource;
use App\Http\Resources\TicketResource;


class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $airline = $this->whenLoaded('airline');

        return [
            'id' => $this->id,
            'source' => $this->source,
            'destination' => $this->destination,
            'departure_time' => $this->departure_time,
            'airline' => new AirlineResource($airline),
            'tickets' => TicketResource::collection($this->whenLoaded('tickets')),
        ];
    }
}
