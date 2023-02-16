<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Table extends Controller
{
    public function data_table(Request $req)
    {
        try {

            if ($req->has('q')) {
                $q = $req->input('q');
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE location_name LIKE ? GROUP BY article_name, type_name, model, variety, details2 ORDER BY inventories.created_at DESC', ["%$q%"]);

                return response()->json($table);
            } else {
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId GROUP BY article_name, type_name, model, variety, details2 ORDER BY inventories.created_at DESC');

                return response()->json($table);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function details(Request $req)
    {
        try {
            $l = $req->desc;
            $detail = DB::select('SELECT *, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) LIKE ?', ["%$l%"]);

            return response()->json($detail);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function header(Request $req){
        try {
            $title = $req->header;
            $data = DB::select('SELECT DISTINCT item_name from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ?', ["$title"]);

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
