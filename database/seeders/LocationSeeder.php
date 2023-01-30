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
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('location')->insert([
            "location_name" => Str::random(3) . "location",
            "created_at" => Carbon::now(),
            
        ]);
    }
}