<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class acquisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('acquisition')->insert([
            'acquisition_type' => "Purchase",
            "created_at" => Carbon::now(),
        ]);
        DB::table('acquisition')->insert([
            'acquisition_type' => "Donation",
            "created_at" => Carbon::now(),
        ]);
    }
}
