<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class test extends Controller
{
    public function test(Request $request)
    {
        try {

            if ($request->has('q')) {
                # search item
                $q = $request->input('q');
                $items = DB::select("
                    SELECT DISTINCT CONCAT_WS(' ', article_name, type_name, model, variety, details2) AS `desc`, article_name
                    FROM `items` 
                    LEFT JOIN brands on items.Fk_brandId = brands.Pk_brandId 
                    LEFT JOIN manufacturers on items.Fk_manuId = manufacturers.Pk_manuId
                    LEFT JOIN types on items.Fk_typeId = types.Pk_typeId 
                    LEFT JOIN articles on types.Fk_articleId = articles.Pk_articleId 
                    LEFT JOIN variety on items.Fk_varietyId = variety.Pk_varietyId 
                     WHERE article_name LIKE ? ORDER BY items.created_at DESC;", ["$q"]);

                $data = array();
                $propertArray = array();

                foreach ($items as $a => $itemList) {
                    $itemDesc = $itemList->desc;
                    $itemArticle = $itemList->article_name;

                    $items = DB::select('SELECT * FROM items LEFT JOIN brands ON items.Fk_brandId = brands.Pk_brandId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON articles.Pk_articleId = types.Fk_articleId WHERE article_name LIKE ? ', ["Socket"]);

                    $property = DB::select('SELECT GROUP_CONCAT(DISTINCT property_no SEPARATOR ", ") AS "propConcat" FROM inventories LEFT JOIN items ON inventories.Fk_itemId = items.Pk_itemId LEFT JOIN types ON items.Fk_typeId = types.Pk_typeId LEFT JOIN articles ON types.Fk_articleId = articles.Pk_articleId LEFT JOIN variety ON items.Fk_varietyId = variety.Pk_varietyId LEFT JOIN locat_man ON inventories.Fk_locatmanId = locat_man.Pk_locatmanId LEFT JOIN location ON locat_man.Fk_locationId = location.Pk_locationId WHERE CONCAT_WS(" ", article_name, type_name, model, variety, details2) = ?', ["$itemDesc"]);

                    foreach ($property as $prop => $propValue) {
                        array_push($propertArray, array("property_no" => get_object_vars($propValue)['propConcat']));
                    }

                    array_push($data, array("Pk_itemId" => get_object_vars($items[0])['Pk_itemId'], "item name" => get_object_vars($items[0])['article_name'], "article name" => get_object_vars($items[0])['article_name'], "brand_name" => get_object_vars($items[0])['brand_name'], "detaisl2" => get_object_vars($items[0])['details2'], "property" => $propertArray));

                    $propertArray = array();
                }

                return response()->json($data);

                dd($data);
            }
        } catch (\Throwable $th) {
            return $th;
            return response()->json([
                'status' => 500,
                'message' => $th
            ]);
        }
    }
}
