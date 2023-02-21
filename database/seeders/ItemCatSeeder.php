<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class itemCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 1,
            "itemCateg_name" => "Medical"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 2,
            "itemCateg_name" => "Janitorial"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 3,
            "itemCateg_name" => "Office"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 4,
            "itemCateg_name" => "Furniture"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 5,
            "itemCateg_name" => "Other"
        ]);
    }
}
