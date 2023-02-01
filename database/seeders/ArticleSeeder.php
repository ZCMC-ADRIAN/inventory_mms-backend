<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->insert([
            "Pk_articleId" => 100,
            'article_name' => "Speaker System",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 101,
            'article_name' => "Table",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 102,
            'article_name' => "Printer",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 103,
            'article_name' => "Cabinet",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 104,
            'article_name' => "Projector",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 105,
            'article_name' => "Fan",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 106,
            'article_name' => "Airconditioner",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 107,
            'article_name' => "Camera",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 108,
            'article_name' => "Hard Drive",
            "created_at" => Carbon::now(),
        ]);
        DB::table('articles')->insert([
            "Pk_articleId" => 109,
            'article_name' => "Phone",
            "created_at" => Carbon::now(),
        ]);
    }
}
