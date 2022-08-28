<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            ['name' => 'USA', 'created_at' => now()],
            ['name' => 'Montenegro', 'created_at' => now()],
            ['name' => 'Serbia', 'created_at' => now()],
        ]);
    }
}
