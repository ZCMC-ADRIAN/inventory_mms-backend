<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Pk_supplierId	supplier
        DB::table('suppliers')->insert([
            "Pk_supplierId"=>1,
            'supplier' => "DOH",
            'mode' => 1,
            "created_at" => Carbon::now(),
            
        ]);
        DB::table('suppliers')->insert([
            "Pk_supplierId"=>2,
            'mode' => 0,
            'supplier' => "DONOR pepito",
            "created_at" => Carbon::now(),
        ]);
    }
}
