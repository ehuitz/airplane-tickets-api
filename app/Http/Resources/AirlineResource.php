<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Airline;
use App\Http\Resources\FlightResource;


class AirlineResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'flights' => FlightResource::collection($this->whenLoaded('flights')),
            'tickets' => TicketResource::collection($this->whenLoaded('tickets')),
        ];
    }
}
