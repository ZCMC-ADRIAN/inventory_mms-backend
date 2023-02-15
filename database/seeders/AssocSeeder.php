<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AssocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Pk_assocId	person_name
        DB::table('associate')->insert([
            "Pk_assocId"=> 1,
            "person_name" => "Juan Luna",
            "created_at" => Carbon::now(),
        ]);
        DB::table('associate')->insert([
            "Pk_assocId"=> 2,
            "person_name" => "Sintia Villar",
            "created_at" => Carbon::now(),
        ]);
        DB::table('associate')->insert([
            "Pk_assocId"=> 3,
            "person_name" => "Adrian Agcaoili",
            "created_at" => Carbon::now(),
        ]);
    }
}
