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
                    ->leftJoin('associate', 'associate.Pk_assocId', '=', 'inventories.Fk_assocId')
                    ->leftJoin('location', 'location.Pk_locationId', '=', 'associate.Fk_locationId')
                    ->select('*', DB::raw('FORMAT(cost,2) as costs'), DB::raw('Quantity * pack_size + loose as qty'))
                    ->where('Pk_inventoryId', $req->inId)
                    ->get();
                    
            return response()->json($detail);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function items(Request $req){
        try{
            $items = DB::table('inventories')
                    ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                    ->join('locat_man', 'inventories.Fk_locatmanId', '=', 'locat_man.Pk_locatmanId')
                    ->join('location', 'locat_man.Fk_locationId', '=', 'location.Pk_locationId')
                    ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
                    ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                    ->join('variety', 'items.Fk_varietyId', '=', 'variety.Pk_varietyId')
                    ->select('location_name', 'Quantity',DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc"'))
                    ->where(DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2)'), $req->desc)
                    ->get();

            return response()->json($items);

        } catch (\Throwable $th){
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
