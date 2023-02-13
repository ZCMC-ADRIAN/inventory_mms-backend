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
                $table = DB::select('SELECT location_name, Quantity, `serial`, property_no,  CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories INNER JOIN items ON inventories.Fk_itemId = items.Pk_itemId INNER JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId INNER JOIN location ON locat_man.Fk_locationId = location.Pk_locationId INNER JOIN types ON items.Fk_typeId = types.Pk_typeId INNER JOIN articles ON types.Fk_articleId = articles.Pk_articleId INNER JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE location_name LIKE ?', ["%$q%"]);

                return response()->json($table);
            } else {
                $table = DB::table('inventories')
                    ->join('items', 'inventories.Fk_itemId', '=', 'items.Pk_itemId')
                    ->join('types', 'items.Fk_typeId', '=', 'types.Pk_typeId')
                    ->join('articles', 'types.Fk_articleId', '=', 'articles.Pk_articleId')
                    ->leftJoin('variety', 'variety.Pk_varietyId', '=', 'items.Fk_varietyId')
                    ->select('*', DB::raw('CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc"'))
                    ->get();

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
}
