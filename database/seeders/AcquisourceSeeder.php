<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class acquisourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('acquisource')->insert([
            'source_name' => "DOH",
            "created_at" => Carbon::now(),
        ]);
        DB::table('acquisource')->insert([
            'source_name' => "Dennis Hardware",
            "created_at" => Carbon::now(),
        ]);
        DB::table('acquisource')->insert([
            'source_name' => NULL,
            "created_at" => Carbon::now(),
        ]);
    }
}
