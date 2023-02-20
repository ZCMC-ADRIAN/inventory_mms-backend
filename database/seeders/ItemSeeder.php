<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //				created_at	updated_at	

        DB::table('items')->insert([
            "Pk_itemId" => 1,
            "Fk_typeId" => 5,
            "Fk_statusId" => 1,
            "Fk_manuId" => 2,
            "Fk_supplierId" => 1,
            "Fk_unitId" => 1,
            "Fk_varietyId" => 2,
            "Fk_brandId" => 1,
            "Fk_countryId" => 1,
            "Fk_itemCategId" => 1,
            'item_name' => "table",
            'model' => "model is unique",
            'details2' => "details ",
            'other' => "other details",
            'warranty' => Carbon::now(),
            'acquisition_date' => Carbon::now(),
            'expiration' => Carbon::now(),
            'fundSource' => 'Donation',
            'remarks' => "remarks",
            "created_at" => Carbon::now(),
        ]);

        DB::table('items')->insert([
            "Pk_itemId" => 2,
            "Fk_typeId" => 2,
            "Fk_statusId" => 2,
            "Fk_manuId" => 1,
            "Fk_supplierId" => 2,
            "Fk_unitId" => 1,
            "Fk_varietyId" => 2,
            "Fk_brandId" => 1,
            "Fk_countryId" => 2,
            "Fk_itemCategId" => 2,
            'item_name' => "table",
            'model' => "model2",
            'details2' => "zzzzzzz ",
            'other' => "ssample",
            'warranty' => Carbon::now(),
            'acquisition_date' => Carbon::now(),
            'expiration' => Carbon::now(),
            'fundSource' => 'Donation',
            'remarks' => 'remarks',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('items')->insert([
            "Pk_itemId" => 3,
            "Fk_typeId" => 4,
            "Fk_statusId" => 2,
            "Fk_manuId" => 2,
            "Fk_supplierId" => 2,
            "Fk_unitId" => 2,
            "Fk_varietyId" => 2,
            "Fk_brandId" => 2,
            "Fk_countryId" => 1,
            "Fk_itemCategId" => 4,
            'item_name' => "table",
            'model' => "model2",
            'details2' => "sample details ",
            'other' => "new table",
            'warranty' => Carbon::now(),
            'acquisition_date' => Carbon::now(),
            'expiration' => Carbon::now(),
            'fundSource' => 'Donation',
            'remarks' => 'sample remarks',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('items')->insert([
            "Pk_itemId" => 4,
            "Fk_typeId" => 1,
            "Fk_statusId" => 1,
            "Fk_manuId" => 1,
            "Fk_supplierId" => 2,
            "Fk_unitId" => 2,
            "Fk_varietyId" => 1,
            "Fk_brandId" => 1,
            "Fk_countryId" => 1,
            "Fk_itemCategId" => 1,
            'item_name' => "Computer",
            'model' => "New Model",
            'details2' => "16GB RAM ",
            'other' => "32 inch screen",
            'warranty' => Carbon::now(),
            'acquisition_date' => Carbon::now(),
            'expiration' => Carbon::now(),
            'fundSource' => 'Donation',
            'remarks' => ' sample remarks',
            'created_at' => Carbon::now(),
            
        ]);
        DB::table('items')->insert([
            "Pk_itemId" => 5,
            "Fk_typeId" => 3,
            "Fk_statusId" => 1,
            "Fk_manuId" => 1,
            "Fk_supplierId" => 2,
            "Fk_unitId" => 2,
            "Fk_varietyId" => 1,
            "Fk_brandId" => 1,
            "Fk_countryId" => 1,
            "Fk_itemCategId" => 1,
            'item_name' => "Laptop",
            'model' => "Nitro 5",
            'details2' => "8GB RAM ",
            'other' => "New Laptop",
            'warranty' => Carbon::now(),
            'acquisition_date' => Carbon::now(),
            'expiration' => Carbon::now(),
            'fundSource' => 'Donation',
            'remarks' => 'sample remarks',
            'created_at' => Carbon::now(),
            
        ]);
        
    }
}