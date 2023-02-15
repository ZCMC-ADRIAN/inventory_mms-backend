<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\
        DB::table('location')->insert([
            "location_name" => 'Eye Center',
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => 'OMCC',
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => 'OPCEN',
            "created_at" => Carbon::now(),
            
        ]);
    }
}