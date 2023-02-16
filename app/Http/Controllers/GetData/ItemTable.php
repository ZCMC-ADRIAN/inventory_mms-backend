<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTable extends Controller
{
    public function locations(Request $request)
    {
        //SELECT Pk_locationId, location_name FROM `location` WHERE 1;
        try {
            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $location = DB::select("SELECT Pk_locationId, location_name FROM `location` WHERE location_name LIKE ?", ["%$q%"]);
                return response()->json($location);
            } else {
                # code...
                $location = DB::table('location')->select(
                    ["Pk_locationId", "location_name"]
                )->get();
                return response()->json($location);
            }
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }

    public function items(Request $req)
    {
        try {
            if ($req->has('q')) {
                $q = $req->input('q');
                $l = $req->desc;
                $items = DB::select('SELECT *, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE location_name LIKE ? AND CONCAT_WS(" ", article_name, type_name, model, variety, details2) LIKE ?', ["%$q%", "%$l%"]);

                return response()->json($items);
            } else {
                $l = $req->desc;
                $items = DB::select('SELECT *, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) LIKE ?', ["%$l%"]);

                return response()->json($items);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
