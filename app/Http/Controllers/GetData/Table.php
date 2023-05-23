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
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty, itemCateg_name from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE property_no LIKE ? OR `serial` LIKE ? OR location_name LIKE ? GROUP BY article_name, type_name, model, variety, details2, itemCateg_name ORDER BY inventories.created_at DESC', ["%$q%", "%$q%", "%$q%"]);

                return response()->json($table);
            } else {
                $table = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", SUM(Quantity) as total_qty, itemCateg_name from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId GROUP BY article_name, type_name, model, variety, details2, itemCateg_name ORDER BY inventories.created_at DESC');

                return response()->json($table);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th -> getMessage()
            ]);
        }
    }

    public function details(Request $req)
    {
        try {
            $l = $req->inventoryId;
            $detail = DB::select('SELECT property_no, serial, location_name, person_name, unit, SUM(Quantity) as qty, cost, cost * Quantity as total_cost, brand_name, article_name, type_name, conditions_name, model, warranty, acquisition_date, fundSource, CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN conditions ON conditions.Pk_conditionsId = inventories.Fk_conditionsId LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId WHERE Pk_inventoryId = ? GROUP BY property_no, serial, location_name, person_name, cost, variety, details2, unit, Quantity, brand_name, article_name, type_name, conditions_name, model, warranty, acquisition_date, fundSource', ["$l"]);

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

    public function report(Request $req){
        try {
            $location = $req->location;

            $itemName = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE location_name = ?', ["$location"]);

            $data = array();
            $temp = array();
            $propertArr = array();

            forEach ($itemName as $num => $items) {
                $itemDesc = $items->desc;
    
                $report = DB::select('SELECT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", Quantity, Delivery_date, FORMAT(cost,2) AS "costs", FORMAT(cost * Quantity,2) as "total_cost", inventories.remarks from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = ?', ["$itemDesc","$location"]);

                $details = DB::select('SELECT article_name, unit, location_name, FORMAT(cost,2) AS "costs", SUM(Quantity) AS "qty", FORMAT(cost * SUM(Quantity),2) AS "total" FROM items LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = ? GROUP BY article_name, unit, location_name, cost', ["$itemDesc", "$location"]);
    
                $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = ?', ["$itemDesc", "$location"]);
    
                $person = DB::select('SELECT DISTINCT person_name FROM items LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND location_name = ?', ["$itemDesc", "$location"]);
                
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

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function person(Request $req){
        try {
            
            $person = DB::select("SELECT DISTINCT person_name FROM associate WHERE person_name NOT IN ('none')");
            
            return response()->json($person);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function reportPerson(Request $req){
        try {
            $person = $req->person;

            $itemName = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE person_name = ?', ["$person"]);

            $data = array();
            $temp = array();
            $propertArr = array();

            forEach ($itemName as $num => $items) {
                $itemDesc = $items->desc;
    
                $report = DB::select('SELECT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", Quantity, Delivery_date, FORMAT(cost,2) AS "costs", FORMAT(cost * Quantity,2) as "total_cost", inventories.remarks from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND person_name = ?', ["$itemDesc","$person"]);

                $details = DB::select('SELECT article_name, unit, location_name, FORMAT(cost,2) AS "costs", SUM(Quantity) AS "qty", FORMAT(cost * SUM(Quantity),2) AS "total" FROM items LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND person_name = ? GROUP BY article_name, unit, person_name, location_name, cost', ["$itemDesc", "$person"]);
    
                $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND person_name = ?', ["$itemDesc", "$person"]);
    
                $personName = DB::select('SELECT DISTINCT person_name FROM items LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND person_name = ?', ["$itemDesc", "$person"]);
                
                foreach($report as $index => $item){
                    array_push($temp,array("delivery"=>get_object_vars($item)["Delivery_date"], "remarks"=>get_object_vars($item)["remarks"]));
                }
    
                foreach($property as $prop => $propValue){
                    array_push($propertArr, array("property_no"=>get_object_vars($propValue)['propConcat']));
                }
    
                array_push($data,array("desc"=>get_object_vars($report[0])['desc'], "article"=>get_object_vars($details[0])['article_name'], "unit"=>get_object_vars($details[0])['unit'], "location"=>get_object_vars($details[0])['location_name'], "person"=>get_object_vars($personName[0])['person_name'], "cost"=>get_object_vars($details[0])['costs'], "qty"=>get_object_vars($details[0])['qty'], "total"=>get_object_vars($details[0])['total'],"details"=>$temp, "property"=>$propertArr));
                
                $temp = array();
                $propertArr = array();
            }
            return response()->json($data);
            
            dd($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

    public function notFound(Request $req){
        try {
            $condition = "Not Found";

            $itemName = DB::select('SELECT DISTINCT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN conditions ON inventories.Fk_conditionsId = conditions.Pk_conditionsId WHERE conditions_name = ?', ["$condition"]);

            $data = array();
            $temp = array();
            $propertArr = array();

            forEach ($itemName as $num => $items) {
                $itemDesc = $items->desc;
    
                $report = DB::select('SELECT CONCAT_WS(" ", article_name, type_name, model, variety, details2) AS "desc", Quantity, Delivery_date, FORMAT(cost,2) AS "costs", FORMAT(cost * Quantity,2) as "total_cost", inventories.remarks from inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN itemcateg ON items.Fk_itemCategId = itemcateg.Pk_itemCategId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN conditions ON inventories.Fk_conditionsId = conditions.Pk_conditionsId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND conditions_name = ?', ["$itemDesc","$condition"]);

                $details = DB::select('SELECT article_name, unit, location_name, FORMAT(cost,2) AS "costs", SUM(Quantity) AS "qty", FORMAT(cost * SUM(Quantity),2) AS "total" FROM items LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN units ON items.Fk_unitId = units.Pk_unitId LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN conditions ON inventories.Fk_conditionsId = conditions.Pk_conditionsId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND conditions_name = ? GROUP BY article_name, unit, person_name, location_name, cost', ["$itemDesc", "$condition"]);
    
                $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND person_name = ?', ["$itemDesc", "$condition"]);
    
                $personName = DB::select('SELECT DISTINCT person_name FROM items LEFT JOIN inventories ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN associate ON locat_man.Fk_assocId = associate.Pk_assocId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN conditions ON inventories.Fk_conditionsId = conditions.Pk_conditionsId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ? AND conditions_name = ?', ["$itemDesc", "$condition"]);
                
                foreach($report as $index => $item){
                    array_push($temp,array("delivery"=>get_object_vars($item)["Delivery_date"], "remarks"=>get_object_vars($item)["remarks"]));
                }
    
                foreach($property as $prop => $propValue){
                    array_push($propertArr, array("property_no"=>get_object_vars($propValue)['propConcat']));
                }
    
                array_push($data,array("desc"=>get_object_vars($report[0])['desc'], "article"=>get_object_vars($details[0])['article_name'], "unit"=>get_object_vars($details[0])['unit'], "location"=>get_object_vars($details[0])['location_name'], "person"=>get_object_vars($personName[0])['person_name'], "cost"=>get_object_vars($details[0])['costs'], "qty"=>get_object_vars($details[0])['qty'], "total"=>get_object_vars($details[0])['total'],"details"=>$temp, "property"=>$propertArr));
                
                $temp = array();
                $propertArr = array();
            }
            return response()->json($data);
            
            dd($data);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th
            ]);
        }
    }

}
