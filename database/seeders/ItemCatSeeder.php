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
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 7,
            "itemCateg_name" => "Machinery",
            "code" => "05-01"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 3,
            "itemCateg_name" => "Office Equipment",
            "code" => "05-02"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 4,
            "itemCateg_name" => "Information and Communication Technology Equipment",
            "code" => "05-03"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 8,
            "itemCateg_name" => "Agricultural and Forestry",
            "code" => "05-04"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 9,
            "itemCateg_name" => "Marine and Fishery",
            "code" => "05-05"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 10,
            "itemCateg_name" => "Airport Equipment",
            "code" => "05-06"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 11,
            "itemCateg_name" => "Communication Equipment",
            "code" => "05-07"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 12,
            "itemCateg_name" => "Disaster Response and Rescue Equipment",
            "code" => "05-08"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 13,
            "itemCateg_name" => "Military Police and Security",
            "code" => "05-09"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 1,
            "itemCateg_name" => "Medical Equipment",
            "code" => "05-10"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 14,
            "itemCateg_name" => "Printing Equipment",
            "code" => "05-11"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 15,
            "itemCateg_name" => "Sports Equipment",
            "code" => "05-12"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 16,
            "itemCateg_name" => "Technical and Scientific Equipment",
            "code" => "05-13"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 17,
            "itemCateg_name" => "Other Machinery and Equipment",
            "code" => "05-19"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 2,
            "itemCateg_name" => "Janitorial Equipment",
            "code" => "06-03"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 5,
            "itemCateg_name" => "Furnitures and Fixtures",
            "code" => "06-01"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 18,
            "itemCateg_name" => "Books",
            "code" => "06-02"
        ]);
        DB::table('itemCateg')->insert([
            "Pk_itemCategId" => 6,
            "itemCateg_name" => "Other",
            "code" => "09-09"
        ]);
    }
}
