<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {

            $items = DB::select('SELECT Fk_propertyId, Pk_inventoryId, serial, barcode, location_name, person_name, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", CONCAT_WS("-", "2023", code, series, area_code) AS "property_no" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON itemcateg.Pk_itemCategId = items.Fk_itemCategId LEFT JOIN propertyno ON propertyno.Pk_propertyId = inventories.Fk_propertyId LEFT JOIN par_series ON propertyno.Fk_parId = par_series.Pk_parId WHERE Pk_itemId= ?', ["8702"]);
            
            foreach($items as $id){
                $propertId = $id->Fk_propertyId;
            }

            if($propertId != NULL){
                foreach($items as $inf){
                    $get_info = $inf->property_no;
                }
            }

            return response()->json($get_info);

        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
}
