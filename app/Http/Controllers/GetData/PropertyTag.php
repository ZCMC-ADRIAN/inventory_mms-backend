<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyTag extends Controller
{
    public function property_tag(Request $req){
        try {
            $location = $req->location;

            $tag = DB::select('SELECT *, CONCAT_WS(" ", article_name, type_name, model, variety) AS "desc", FORMAT(cost,2) as "costs" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId WHERE location_name = ?', ["$location"]);

            return response()->json($tag);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
