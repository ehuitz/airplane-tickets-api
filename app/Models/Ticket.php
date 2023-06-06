<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Flight;
use App\Models\Airline;
use \Znck\Eloquent\Traits\BelongsToThrough;



class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
   
    public function flight(){
        return $this->belongsTo(Flight::class);
    }

    public function airline(){
        return $this->hasOneThrough(Airline::class, Flight::class, 'id', 'id', 'flight_id', 'airline_id');
    }

}
