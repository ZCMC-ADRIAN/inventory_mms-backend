<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // brands Pk_brandId	brand_name	created_at	updated_at	

        DB::table('brands')->insert([
            "Pk_brandId"=>1,
            'brand_name' => "Acer",
            "created_at" => Carbon::now(),
        ]);
        DB::table('brands')->insert([
            "Pk_brandId"=>2,
            'brand_name' => "Lenovo",
            "created_at" => Carbon::now(),
        ]);
    }
}
