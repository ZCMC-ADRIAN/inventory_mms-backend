<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req){
        $table = DB::table('inventories')
        ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
        ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
        ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
        ->leftJoin('variety', 'variety.Pk_varietyId', '=', 'items.Fk_varietyId')
        ->select('*', DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc"'))
        ->get();

    return response()->json($table);
    }
}
