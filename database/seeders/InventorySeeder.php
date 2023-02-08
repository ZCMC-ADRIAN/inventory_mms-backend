<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //	Pk_inventoryId	Fk_itemId	Fk_conditionsId	Fk_locatmanId	
        
        DB::table('inventories')->insert([
            "Pk_inventoryId"=> 1,
            "Fk_itemId" => 1,
            "Fk_conditionsId" => 2,
            "Fk_locatmanId" => 1,
            "Delivery_date" => Carbon::now(),
            "Quantity" => 2,
            "property_no" => Str::random(2)."213",
            "serial" => Str::random(2)."35213",
            "loose" => 123,
            "Remarks" => Str::random(10),
        ]);
        DB::table('inventories')->insert([
            "Pk_inventoryId"=> 2,
            "Fk_itemId" => 2,
            "Fk_conditionsId" => 1,
            "Fk_locatmanId" => 2,
            "Delivery_date" => Carbon::now(),
            "Quantity" => 2,
            "property_no" => Str::random(2)."213",
            "serial" => Str::random(2)."35213",
            "loose" => 123,
            "Remarks" => Str::random(10),
        ]);
        DB::table('inventories')->insert([
            "Pk_inventoryId"=> 3,
            "Fk_itemId" => 2,
            "Fk_conditionsId" => 1,
            "Fk_locatmanId" => 3,
            "Delivery_date" => Carbon::now(),
            "Quantity" => 2,
            "property_no" => Str::random(2)."213",
            "serial" => Str::random(2)."35213",
            "loose" => 123,
            "Remarks" => Str::random(10),
        ]);
    }
}
