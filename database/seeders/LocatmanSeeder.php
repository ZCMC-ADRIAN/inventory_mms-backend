<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
class LocatmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('locat_man')->insert([
            'Pk_locatmanId'=>1,
            'Fk_assocId'=>1,
            'Fk_locationId'=>1
        ]);
        DB::table('locat_man')->insert([
            'Pk_locatmanId'=>2,
            'Fk_assocId'=>2,
            'Fk_locationId'=>1
        ]);
        DB::table('locat_man')->insert([
            'Pk_locatmanId'=>3,
            'Fk_assocId'=>3,
            'Fk_locationId'=>2
        ]);
        
    }
}
