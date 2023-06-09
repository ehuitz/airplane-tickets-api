<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Airline;
use App\Models\Ticket;




class Flight extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function airline(){
        return $this->belongsTo(Airline::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
