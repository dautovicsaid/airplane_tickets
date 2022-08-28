<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name' => 'Atlanta','country_id'=> 1,'created_at' => now()],
            ['name' => 'Los Angeles','country_id'=> 1,'created_at' => now()],
            ['name' => 'Dallas','country_id'=> 1 ,'created_at' => now()],
        ]);
    }
}
