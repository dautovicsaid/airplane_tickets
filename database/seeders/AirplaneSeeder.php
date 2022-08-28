<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirplaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airplanes')->insert([
            ['name' => 'ATR 72', 'economy_seats' => 68,'business_seats' => 35, 'first_seats' => 22, 'created_at' => now()],
            ['name' => 'Airbus A320-100/200', 'economy_seats' => 52,'business_seats' => 11, 'first_seats' => 36,'created_at' => now()],
            ['name' => 'Boeing 737-300 72', 'economy_seats' => 123,'business_seats' => 54, 'first_seats' => 41,'created_at' => now()],
        ]);

    }
}
