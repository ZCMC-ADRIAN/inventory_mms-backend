<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //	Pk_countryId	country	created_at	updated_at
        DB::table('countries')->insert([
            "Pk_countryId"=>1,
            'country' => "Korea",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('countries')->insert([
            "Pk_countryId"=>2,
            'country' => "Japan",
            "created_at" => Carbon::now(),
            
        ]);
    }
}
