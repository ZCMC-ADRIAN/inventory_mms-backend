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
                $location = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no LIKE ? UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` LIKE ? UNION SELECT DISTINCT location_name FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE location_name LIKE ?", ["%$q%", "%$q%", "%$q%"]);
                
                return response()->json($location);
                
            } else {
                # code...
                $location = DB::select("SELECT DISTINCT property_no FROM inventories WHERE property_no IS NOT NULL UNION SELECT DISTINCT `serial` FROM inventories WHERE `serial` IS NOT NULL UNION SELECT DISTINCT location_name FROM inventories LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId");
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
        
            $query = DB::table('inventories')
                ->select('*')
                ->addSelect(DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS `desc`')) // Escaped the alias `desc` with backticks
                ->leftJoin('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->leftJoin('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                ->leftJoin('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                ->leftJoin('article_relation', 'items.Fk_article_relationId', '=', 'article_relation.Pk_article_relationId')
                ->leftJoin('types', 'article_relation.Fk_typeId', '=', 'types.Pk_typeId')
                ->leftJoin('articles', 'article_relation.Fk_articleId', '=', 'articles.Pk_articleId')
                ->leftJoin('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                ->leftJoin('associate', 'locat_man.Fk_assocId', '=', 'associate.Pk_assocId')
                ->orderBy('inventories.created_at', 'DESC');
        
            if ($req->has('q')) {
                $query->where('location_name', 'LIKE', "%$q%")
                      ->where(DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2)'), '=', $l);
            } else {
                $query->where(DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2)'), '=', $l);
            }
        
            $items = $query->get();
        
            return response()->json($items);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }        
    }
}
