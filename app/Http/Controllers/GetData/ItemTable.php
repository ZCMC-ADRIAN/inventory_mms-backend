<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTable extends Controller
{
    public function locations(Request $request)
    {
        try {
            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $location = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no LIKE ? UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` LIKE ? UNION SELECT DISTINCT location_name FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE location_name LIKE ? UNION SELECT DISTINCT article_name FROM articles WHERE article_name LIKE ?", ["%$q%", "%$q%", "%$q%", "%$q%"]);
                
                return response()->json($location);
                
            } else {
                # code...
                $location = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no IS NOT NULL UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` IS NOT NULL UNION SELECT DISTINCT location_name FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId UNION SELECT DISTINCT article_name FROM articles");
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
            $q = $req->input('q');
            $l = $req->desc;

            $sql = DB::select("SELECT *, CONCAT_WS(' ', article_name, type_name, model, variety, details2) AS `desc`
                FROM items
                LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId
                -- LEFT JOIN item_inventory ON inventories.Pk_inventoryId = item_inventory.Fk_inventoryId
                LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId
                LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId
                LEFT JOIN article_relation ON items.Fk_article_relationId = article_relation.Pk_article_relationId
                LEFT JOIN types ON article_relation.Fk_typeId = types.Pk_typeId
                LEFT JOIN articles ON article_relation.Fk_articleId = articles.Pk_articleId
                LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId
                LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId
                WHERE CONCAT_WS(' ', article_name, type_name, items.model, variety, items.details2) = ?
                ORDER BY inventories.created_at DESC",[$l]);
                       
        
            return response()->json($sql);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }        
    }
}
