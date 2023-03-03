<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $l = $req->desc;
        $items = DB::select('SELECT property_no, serial, location_name, person_name, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = "Printer Ink tank"');

        return response()->json($items);
    }
}
