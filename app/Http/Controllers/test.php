<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        try {
            $detail = DB::select('SELECT property_no, serial, model, fundSource, unit, location_name, person_name FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_typeId = variety.Pk_varietyId LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId LEFT JOIN manufacturers ON items.Fk_manuId = manufacturers.Pk_manuId LEFT JOIN suppliers ON items.Fk_supplierId = suppliers.Pk_supplierId LEFT JOIN countries ON items.Fk_countryId = countries.Pk_countryId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId where Pk_inventoryId = 1');

            return response()->json($detail);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }
}
