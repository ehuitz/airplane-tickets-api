<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

       $user =  \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

       $user_token = $user->createToken("API TOKEN")->plainTextToken;
       Log::info($user_token);

       
       $airline1 =  \App\Models\Airline::create([
            'name' => 'American Airlines',
        ]);
        $airline2 =  \App\Models\Airline::create([
            'name' => 'Tropic Air',
        ]);
        $airline3 =  \App\Models\Airline::create([
            'name' => 'Maya Island',
        ]);
        $airline4 =  \App\Models\Airline::create([
            'name' => 'Delta',
        ]);

        $flight1 = \App\Models\Flight::create([
            'airline_id' => $airline1->id,
            'source' => 'BZ',
            'destination' => 'FRA',
            'departure_time'  => '2023-02-02 00:00:01'
        ]);

        $ticket1 = \App\Models\Ticket::create([
            'flight_id' => $flight1->id,
            'holder_name' => 'Elmer Huitz',
            'passport_number' => '123123123',
            'seat'  => 7
        ]);
    }
}
