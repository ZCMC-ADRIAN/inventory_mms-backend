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
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty, itemCateg_name from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE location_name LIKE ? GROUP BY article_name, type_name, model, variety, details2, itemCateg_name ORDER BY inventories.created_at DESC', ["%$q%"]);

                return response()->json($table);
            } else {
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty, itemCateg_name from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId GROUP BY article_name, type_name, model, variety, details2, itemCateg_name ORDER BY inventories.created_at DESC');

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
            $l = $req->inventoryId;
            $detail = DB::select('SELECT property_no, serial, location_name, person_name, unit, SUM(Quantity) as qty, cost, cost * Quantity as total_cost, brand_name, article_name, type_name, status_name, model, warranty, acquisition_date, fundSource, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN status ON items.Fk_statusId = status.Pk_statusId LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId WHERE Pk_inventoryId = ? GROUP BY property_no, serial, location_name, person_name, cost, variety, details2, unit, Quantity, brand_name, article_name, type_name, status_name, model, warranty, acquisition_date, fundSource', ["$l"]);

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
