<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Flight;
use App\Models\Airline;
use App\Http\Resources\AirlineResource;

class FlightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'airline' => new AirlineResource($this->airline),
            'source' => $this->source,
            'destination' => $this->destination,
            'departure_time' => $this->departure_time
        ];
    }
}
