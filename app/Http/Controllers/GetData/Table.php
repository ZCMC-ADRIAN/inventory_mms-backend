<?php

namespace App\Http\Controllers\GetData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Table extends Controller
{
    public function data_table()
    {
        try {
            $table = DB::table('inventories')
                ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
                ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                ->leftJoin('variety', 'variety.Pk_varietyId', '=', 'items.Fk_varietyId')
                ->select('*', DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc"'))
                ->get();

            return response()->json($table);
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function details(Request $req){
        try {
            $detail = DB::table('inventories')
                    ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                    ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
                    ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                    ->leftJoin('variety', 'variety.Pk_varietyId', '=', 'items.Fk_varietyId')
                    ->leftJoin('brands', 'brands.Pk_brandId', '=', 'items.Fk_brandId')
                    ->leftJoin('manufacturers', 'manufacturers.Pk_manuId', '=', 'items.Fk_manuId')
                    ->leftJoin('suppliers', 'manufacturers.Pk_manuId', '=', 'items.Fk_manuId')
                    ->leftJoin('countries', 'countries.Pk_countryId', '=', 'items.Fk_countryId')
                    ->leftJoin('location', 'location.Pk_locationId', '=', 'inventories.Fk_locationId')
                    ->select('*', DB::raw('FORMAT(cost,2) as costs'))
                    ->where('Pk_inventoryId', $req->inId)
                    ->get();
                    
            return response()->json($detail);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
