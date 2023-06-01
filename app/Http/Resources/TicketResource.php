<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ticket;
use App\Models\Flight;
use App\Http\Resources\FlightResource;
 

class TicketResource extends JsonResource
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
            'holder_name' => $this->holder_name,
            'passport_number' => $this->passport_number,
            'seat' => $this->seat,
            'flight' => new FlightResource($this->flight),
        ];
    }
}
