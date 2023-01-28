<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Carbon\Carbon;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
        DB::table('conditions')->insert([
            "conditions_name" => Str::random(2) . "condition",
            "created_at" => Carbon::now(),
        ]);
    }
}