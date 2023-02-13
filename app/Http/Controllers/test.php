<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        try {
            if ($req->has('q')) {
                $q = $req->input('q');
                $l = $req->desc;
                $items = DB::select('SELECT location_name, Quantity, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories INNER JOIN items ON inventories.Fk_itemId = items.Pk_itemId INNER JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId INNER JOIN location ON locat_man.Fk_locationId = location.Pk_locationId INNER JOIN types ON items.Fk_typeId = types.Pk_typeId INNER JOIN articles ON types.Fk_articleId = articles.Pk_articleId INNER JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE location_name LIKE ? AND CONCAT_WS(" ", article_name, type_name, model, variety, details2) LIKE ?',["%kLxlocation%", "%Drive External model is unique Blue details%"]);
                return response()->json($items);
            } else {
                $items = DB::table('inventories')
                    ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                    ->join('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                    ->join('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                    ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
                    ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                    ->join('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                    ->select('location_name', 'Quantity', DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc"'))
                    ->where(DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2)'), 'Drive External model is unique Blue details')
                    ->get();

                return response()->json($items);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
