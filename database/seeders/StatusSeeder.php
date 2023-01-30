<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('status')->insert([
            "Pk_statusId"=>1,
            'status_name' => "Functioning",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('status')->insert([
            "Pk_statusId"=>2,
            'status_name' => "Defective",
            "created_at" => Carbon::now(),
            
        ]);
    }
}
