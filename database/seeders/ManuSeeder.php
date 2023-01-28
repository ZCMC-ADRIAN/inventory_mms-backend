<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ManuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('manufacturers')->insert([
            "Pk_manuId"=>1,
            'manu_name' => "Dell Computers",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('manufacturers')->insert([
            "Pk_manuId"=>2,
            'manu_name' => "Acer",
            "created_at" => Carbon::now(),
            
        ]);
    }
}
