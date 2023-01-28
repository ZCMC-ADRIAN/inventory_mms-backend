<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Variety extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //variety Pk_varietyId	variety	created_at	updated_at
        DB::table('variety')->insert([
            "Pk_varietyId" => 1,
            "variety" => "Red",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('variety')->insert([
            "Pk_varietyId" => 2,
            "variety" => "Blue",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('variety')->insert([
            "Pk_varietyId" => 3,
            "variety" => "Yellow",
            "created_at" => Carbon::now(),
            
        ]);	
    }
}
