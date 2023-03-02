<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class acquiModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('acquimode')->insert([
            'Fk_aquisId' => 1,
            'Fk_sourceId' => 2,
            "created_at" => Carbon::now(),
        ]);
        DB::table('acquimode')->insert([
            'Fk_aquisId' => 2,
            'Fk_sourceId' => 1,
            "created_at" => Carbon::now(),
        ]);
        DB::table('acquimode')->insert([
            'Fk_aquisId' => 2,
            'Fk_sourceId' => 3,
            "created_at" => Carbon::now(),
        ]);
    }
}
