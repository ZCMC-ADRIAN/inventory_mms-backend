<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('types')->insert([
            "Pk_typeId" => 1,
            "Fk_articleId" => 105,
            'type_name' => "Electric",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('types')->insert([
            "Pk_typeId" => 2,
            "Fk_articleId" => 106,
            'type_name' => "Window",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('types')->insert([
            "Pk_typeId" => 3,
            "Fk_articleId" => 106,
            'type_name' => "Split",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('types')->insert([
            "Pk_typeId" => 4,
            "Fk_articleId" => 100,
            'type_name' => "Stereo",
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('types')->insert([
            "Pk_typeId" => 5,
            "Fk_articleId" => 108,
            'type_name' => "External",
            "created_at" => Carbon::now(),
            
        ]);


    }
}
