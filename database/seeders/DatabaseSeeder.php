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
    }
}
