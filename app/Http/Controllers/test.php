<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $req)
    {
        $itemName = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE location_name = "Nuclear Medicine"');

        $data = array();
        $temp = array();
        $propertArr = array();

        forEach ($itemName as $num => $items) {
            $itemDesc = $items->desc;

            $report = DB::select('SELECT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", Quantity, Delivery_date, FORMAT(cost,2) AS "costs", FORMAT(cost * Quantity,2) as "total_cost", inventories.remarks from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = "Nuclear Medicine"', ["$itemDesc"]);

            $details = DB::select('SELECT article_name, unit, location_name, FORMAT(cost,2) AS "costs", SUM(Quantity) AS "qty", FORMAT(cost * SUM(Quantity),2) AS "total" FROM items LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = "Nuclear Medicine" GROUP BY article_name, unit, location_name, cost', ["$itemDesc"]);

            $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = "Nuclear Medicine"', ["$itemDesc"]);

            $person = DB::select('SELECT DISTINCT person_name FROM items LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = "Nuclear Medicine"', ["$itemDesc"]);
            
            foreach($report as $index => $item){
                array_push($temp,array("delivery"=>get_object_vars($item)["Delivery_date"], "remarks"=>get_object_vars($item)["remarks"]));
            }

            foreach($property as $prop => $propValue){
                array_push($propertArr, array("property_no"=>get_object_vars($propValue)['propConcat']));
            }

            array_push($data,array("desc"=>get_object_vars($report[0])['desc'], "article"=>get_object_vars($details[0])['article_name'], "unit"=>get_object_vars($details[0])['unit'], "location"=>get_object_vars($details[0])['location_name'], "person"=>get_object_vars($person[0])['person_name'], "cost"=>get_object_vars($details[0])['costs'], "qty"=>get_object_vars($details[0])['qty'], "total"=>get_object_vars($details[0])['total'],"details"=>$temp, "property"=>$propertArr));
            
            $temp = array();
            $propertArr = array();
        }
        return response()->json($data);
        dd($data);
    }
}
