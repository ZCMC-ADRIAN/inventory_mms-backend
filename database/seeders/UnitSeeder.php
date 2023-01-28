<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('units')->insert([
            "Pk_unitId"=>1,
            'unit' => "pcs",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('units')->insert([
            "Pk_unitId"=>2,
            'unit' => "Box",
            "created_at" => Carbon::now(),
            
        ]);
    }
}
