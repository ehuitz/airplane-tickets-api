<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\Models\Flight;



class Airline extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function flights(){

        return $this->hasMany(Flight::class);
    }

   
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, Flight::class);
    }
}
